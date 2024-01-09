window.addEventListener('load', () => {
  const tableNameUserInput = document.getElementById("tableNameUser");

  if(tableNameUserInput.value === 'Suscriptores'){
    const tableNameUserFeedbackMessage = document.querySelector("#tableNameUser + div");

    const usuarioInput = document.getElementById("usuario");
    const usuarioFeedbackMessage = document.querySelector("#usuario + label + div");
    usuarioInput.addEventListener('input', (event) =>{
      isInvalidStrWord(usuarioInput, usuarioFeedbackMessage);
    });

    const contrasenaInput = document.getElementById("contrasena");
    const contrasenaFeedbackMessage = document.querySelector("#contrasena + label + div");
    contrasenaInput.addEventListener('input', (event) =>{
      isInvalidStrWord(contrasenaInput, contrasenaFeedbackMessage);
    });

    const nombreInput = document.getElementById("nombre");
    const nombreFeedbackMessage = document.querySelector("#nombre + label + div");
    nombreInput.addEventListener('input', (event) =>{
      isInvalidStrWord(nombreInput, nombreFeedbackMessage);
    });

    const apellidoPInput = document.getElementById("apellidoP");
    const apellidoPFeedbackMessage = document.querySelector("#apellidoP + label + div");
    apellidoPInput.addEventListener('input', (event) =>{
      isInvalidStrWord(apellidoPInput, apellidoPFeedbackMessage);
    });

    const apellidoMInput = document.getElementById("apellidoM");
    const apellidoMFeedbackMessage = document.querySelector("#apellidoM + label + div");
    apellidoMInput.addEventListener('input', (event) =>{
      isInvalidStrWord(apellidoMInput, apellidoMFeedbackMessage);
    });

    const fechaNInput = document.getElementById("fechaN");
    const fechaNFeedbackMessage = document.querySelector("#fechaN + label + div");
    fechaNInput.addEventListener('input', (event) =>{
      isInvalidTrue(fechaNInput, fechaNFeedbackMessage);
    });

    const sexoInput = document.getElementById("sexo");
    const sexoFeedbackMessage = document.querySelector("#sexo + label + div");
    sexoInput.addEventListener('input', (event) =>{
      isInvalidSex(sexoInput, sexoFeedbackMessage);
    });

    const estadoNInput = document.getElementById("estadoN");
    const estadoNFeedbackMessage = document.querySelector("#estadoN + label + div");
    estadoNInput.addEventListener('input', (event) =>{
      isInvalidTrue(estadoNInput, estadoNFeedbackMessage);
    });

    const membresiaInput = document.getElementById("membresia");
    const membresiaFeedbackMessage = document.querySelector("#membresia + label + div");
    membresiaInput.addEventListener('input', (event) =>{
      isInvalidMembership(membresiaInput, membresiaFeedbackMessage);
    });

    const tarjetaInput = document.getElementById("tarjeta");
    const tarjetaFeedbackMessage = document.querySelector("#tarjeta + label + div");
    tarjetaInput.addEventListener('input', (event) =>{
      isInvalidCard(tarjetaInput, tarjetaFeedbackMessage);
    });

    const cargoInput = document.getElementById("cargo");
    const cargoFeedbackMessage = document.querySelector("#cargo + label + div");
    cargoInput.addEventListener('input', (event) =>{
      isInvalidCharge(cargoInput, cargoFeedbackMessage);
    });


    const form = document.getElementById("myForm");
    form.addEventListener('submit', (event) => {
      if(isInvalidStrWord(usuarioInput, usuarioFeedbackMessage)||
         isInvalidStrWord(contrasenaInput, contrasenaFeedbackMessage)||
         isInvalidStrWord(nombreInput, nombreFeedbackMessage)||
         isInvalidStrWord(apellidoPInput, apellidoPFeedbackMessage)||
         isInvalidStrWord(apellidoMInput, apellidoMFeedbackMessage)||
         isInvalidTrue(fechaNInput, fechaNFeedbackMessage)||
         isInvalidSex(sexoInput, sexoFeedbackMessage)||
         isInvalidTrue(estadoNInput, estadoNFeedbackMessage)||
         isInvalidMembership(membresiaInput, membresiaFeedbackMessage)||
         isInvalidCard(tarjetaInput, tarjetaFeedbackMessage)||
         isInvalidCharge(cargoInput, cargoFeedbackMessage))
      {
        tableNameUserInput.className = 'form-control is-invalid';
        tableNameUserFeedbackMessage.className = 'invalid-feedback';
        tableNameUserFeedbackMessage.textContent = 'Verifique los campos, uno o mas son invalidos.';
        event.preventDefault();

      }else{
        const FD = new FormData(form);
        let nombre = FD.get('nombre');
        let apellidoP = FD.get('apellidoP');
        let apellidoM = FD.get('apellidoM');
        let fechaN = new Date(FD.get('fechaN'));
        let sexo = FD.get('sexo');
        let estadoN = FD.get('estadoN');

        let month = fechaN.getMonth();
        month = (month + 1).toString().padStart(2, '0');
        let day = fechaN.getDate();
        day = (day + 1).toString().padStart(2, '0');
        let year = fechaN.getFullYear();
        year = year.toString().slice(-2);

        let CURP = apellidoP[0]+getFirstInternalVowel(apellidoP)+apellidoM[0]+nombre[0]+year+month+day+sexo+getShortState(estadoN)+getFirstInternalConsonant(apellidoP)+getFirstInternalConsonant(apellidoM)+getFirstInternalConsonant(nombre)+getCharCURP(year)+getRandomNumber();
        
        let fechaI = new Date();
        fechaI = fechaI.toISOString().split("T")[0];

        let fechaT = new Date();
        let membresia = FD.get('membresia');
        if (membresia == 'Anual'){
          fechaT.setFullYear(fechaT.getFullYear()+1);
        }else{
          fechaT.setMonth(fechaT.getMonth()+1);
        }
        fechaT = fechaT.toISOString().split("T")[0];

        let inputCURP = document.createElement('input');
        inputCURP.setAttribute('name', 'CURP');
        inputCURP.setAttribute('value', CURP);

        let inputfechaI = document.createElement('input');
        inputfechaI.setAttribute('name', 'fechaI');
        inputfechaI.setAttribute('value', fechaI);

        let inputfechaT = document.createElement('input');
        inputfechaT.setAttribute('name', 'fechaT');
        inputfechaT.setAttribute('value', fechaT);

        form.append(inputCURP, inputfechaI, inputfechaT);

        }
    });
  }
});

function getCharCURP(year) {
  if(year<2000){
    return getRandomNumber();
  }else{
    return getRandomLetter();
  }
}

function getRandomNumber() {
  return Math.floor(Math.random() * 10);
}

function getRandomLetter() {
  const alphabet = "abcdefghijklmnopqrstuvwxyz"
  let result = alphabet[Math.floor(Math.random() * alphabet.length)];
  return result.toUpperCase()
}

function getShortState(state){
  state = state.toUpperCase();
  switch(state) {
    case 'AGUASCALIENTES':
      return 'AS';
      break;
    case 'BAJA CALIFORNIA SUR':
      return 'BS';
      break;
    case 'COAHUILA':
      return 'CL';
      break;
    case 'CHIAPAS':
      return 'CS';
      break;
    case 'DISTRITO FEDERAL':
      return 'DF';
      break;
    case 'CIUDAD DE MEXICO':
      return 'DF';
      break;
    case 'GUANAJUATO':
      return 'GT';
      break;
    case 'HIDALGO':
      return 'HG';
      break;
    case 'MEXICO':
      return 'MC';
      break;
    case 'ESTADO DE MEXICO':
      return 'MC';
      break;
    case 'MORELOS':
      return 'MS';
      break;
    case 'NUEVO LEON':
      return 'NL';
      break;
    case 'PUEBLA':
      return 'PL';
      break;
    case 'QUINTANA ROO':
      return 'QR';
      break;
    case 'SINALOA':
      return 'SL';
      break;
    case 'TABASCO':
      return 'TC';
      break;
    case 'TLAXCALA':
      return 'TL';
      break;
    case 'YUCATAN':
      return 'YN';
      break;
    case 'BAJA CALIFORNIA':
      return 'BC';
      break;
    case 'CAMPECHE':
      return 'CC';
      break;
    case 'COLIMA':
      return 'CM';
      break;
    case 'CHIHUAHUA':
      return 'CH';
      break;
    case 'DURANGO':
      return 'DG';
      break;
    case 'GUERRERO':
      return 'GR';
      break;
    case 'JALISCO':
      return 'JC';
      break;
    case 'MICHOACAN':
      return 'MN';
      break;
    case 'NAYARIT':
      return 'NT';
      break;
    case 'OAXACA':
      return 'OC';
      break;
    case 'QUERETARO':
      return 'QT';
      break;
    case 'SAN LUIS POTOSI':
      return 'SP';
      break;
    case 'SONORA':
      return 'SR';
      break;
    case 'TAMAULIPAS':
      return 'TS';
      break;
    case 'VERACRUZ':
      return 'VZ';
      break;
    case 'ZACATECAS':
      return 'ZS';
      break;
    default:
      return 'NE';
  }
}

function getFirstInternalConsonant(s){
    for (let i = 0; i < s.length; i++) {
        if (!isVowel(s[i])){
          if(i == 0)
            continue;
        return s[i].toUpperCase();
      }  
    }
}

function getFirstInternalVowel(s){
  for (let i = 0; i < s.length; i++) {
      if (isVowel(s[i])){
        if(i == 0)
          continue;
        return s[i].toUpperCase();
      }    
  }
}

function isVowel(c){
  c = (c.toLowerCase());
  if (c == 'a' || c == 'e' || c == 'i'
      || c == 'o' || c == 'u')
      return true;
  return false;
}

function isInvalidStrWord(inputObject, FeedbackMessageObject){
  let regex = /^[A-Za-z0-9]*$/; 
  if(regex.test(inputObject.value)){
    inputObject.className = 'form-control is-valid';
    FeedbackMessageObject.className = 'valid-feedback';
    FeedbackMessageObject.textContent = '';
    return false;
  }else{
    inputObject.className = 'form-control is-invalid';
    FeedbackMessageObject.className = 'invalid-feedback';
    FeedbackMessageObject.textContent = 'Use solo numeros y letras, sin espacios';
    return true;
  }
}

function isInvalidMembership(inputObject, FeedbackMessageObject){
  if((inputObject.value == 'Mensual') || (inputObject.value === 'Anual')){
    inputObject.className = 'form-control is-valid';
    FeedbackMessageObject.className = 'valid-feedback';
    FeedbackMessageObject.textContent = '';
    return false;
  }else{
    inputObject.className = 'form-control is-invalid';
    FeedbackMessageObject.className = 'invalid-feedback';
    FeedbackMessageObject.textContent = 'Use solo "Mensual" o "Anual"';
    return true;
  }
}

function isInvalidCard(inputObject, FeedbackMessageObject){
  if(inputObject.value > 0){
    inputObject.className = 'form-control is-valid';
    FeedbackMessageObject.className = 'valid-feedback';
    FeedbackMessageObject.textContent = '';
    return false;
  }else{
    inputObject.className = 'form-control is-invalid';
    FeedbackMessageObject.className = 'invalid-feedback';
    FeedbackMessageObject.textContent = 'Use un numero mayor a 0';
    return true;
  }
}

function isInvalidCharge(inputObject, FeedbackMessageObject){
  if(inputObject.value > 0.01){
    inputObject.className = 'form-control is-valid';
    FeedbackMessageObject.className = 'valid-feedback';
    FeedbackMessageObject.textContent = '';
    return false;
  }else{
    inputObject.className = 'form-control is-invalid';
    FeedbackMessageObject.className = 'invalid-feedback';
    FeedbackMessageObject.textContent = 'Solo se aceptan cargos mayores a 0.01';
    return true;
  }
}

function isInvalidSex(inputObject, FeedbackMessageObject){
  if((inputObject.value === 'M')||(inputObject.value === 'H')){
    inputObject.className = 'form-control is-valid';
    FeedbackMessageObject.className = 'valid-feedback';
    FeedbackMessageObject.textContent = '';
    return false;
  }else{
    inputObject.className = 'form-control is-invalid';
    FeedbackMessageObject.className = 'invalid-feedback';
    FeedbackMessageObject.textContent = 'Solo se aceptan "M" o "H"';
    return true;
  }
}

function isInvalidTrue(inputObject, FeedbackMessageObject){
  if(true){
    inputObject.className = 'form-control is-valid';
    FeedbackMessageObject.className = 'valid-feedback';
    FeedbackMessageObject.textContent = '';
    return false;
  }
}
