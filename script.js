const phone = document.querySelector("#phNum");
const numMSg =  document.querySelector("#numMsg");

const emailInput = document.querySelector("#email");
const emailValidate = document.querySelector("#emailValidateMsg");

function validateEmail() {
  const email = emailInput.value;
  const re = /\S+@\S+\.\S+/;
  if (re.test(email)) {
    emailInput.classList.remove("is-invalid");
    emailInput.classList.add("is-valid");
    emailValidate.classList.remove('text-danger');
    emailValidate.innerHTML = "";
    console.log("hi");
  } else {
    emailValidate.classList.add('text-danger');
    emailValidate.innerHTML = "Please enter a valid email address.";
  }
}

emailInput.addEventListener("keyup", validateEmail);

const phoneInput = document.getElementById('phNum');
  const phoneMsg = document.getElementById('numMsg');

  phoneInput.addEventListener('input', function() {
    const phonePattern = /^\d{10}$/; // regular expression to match a 10-digit phone number
    if (phonePattern.test(phoneInput.value)) {
      phoneMsg.textContent = '';
      phoneMsg.classList.remove('text-danger');
    } else {
      phoneMsg.textContent = 'Please enter a valid phone number.';
      phoneMsg.classList.remove('text-success');
      phoneMsg.classList.add('text-danger');
    }
  });