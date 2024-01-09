const displayedFigure = document.querySelector('.full-img');
const thumbBar = document.querySelector('.thumb-bar');

/* Declaring the array of image filenames */

const images = ['pic1.jpg', 'pic2.jpg', 'pic3.jpg'];
const captions = {
  'pic1.jpg' : 'The Shining',
  'pic2.jpg' : 'It II',
  'pic3.jpg' : 'Interestellar'
}

/* Looping through images */

for (const image of images) {
  const newImage = document.createElement('img');
  const newFigCaption = document.createElement('figcaption');
  
  newImage.setAttribute('src', `assets/imagenes/${image}`);
  newFigCaption.setAttribute('class', 'caption');
  newFigCaption.textContent = captions[image];

  const newFigure = document.createElement('figure');
  newFigure.append(newFigCaption, newImage);
  
  thumbBar.appendChild(newFigure);

  newFigure.addEventListener('click', e => {
    displayedFigure.children[0].src = e.currentTarget.children[1].src;
    displayedFigure.children[1].textContent = e.currentTarget.children[0].textContent; 
  });
}

displayedFigure.children[0].addEventListener('mouseover', e => {
  displayedFigure.children[0].className = 'displayedBig-img';
});

displayedFigure.children[0].addEventListener('mouseout', e => {
  displayedFigure.children[0].className = 'displayed-img';
});


displayedFigure.addEventListener('click', e => {
  let xhr = new XMLHttpRequest();
  let filmName = e.currentTarget.children[1].textContent;
  let data = 'filmName=' + filmName;
  xhr.open('POST', 'HUBCgetFilmData.php', true); 
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');                  
  xhr.send(data);
  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        const filmData = document.getElementById('filmData');
        filmData.innerHTML ='<h1>Datos de pelicula</h1><br><br><br><br><br><br><br>' + xhr.responseText;
      } else {
        alert('Hubo un problema con la solicitud');
      }
    }
  }
});
