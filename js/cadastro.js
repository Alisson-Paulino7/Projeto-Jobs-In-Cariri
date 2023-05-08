var currentTab = 0;
showTab(currentTab);

function showTab(n) {
  var i;
  var tabcontent = document.getElementsByClassName("tab-content");
  var tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
    tablinks[i].classList.remove("active");
  }
  tabcontent[n].style.display = "block";
  tablinks[n].classList.add("active");
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == tabcontent.length - 1) {
    document.getElementById("nextBtn").innerHTML = "Concluir";
  } else {
    document.getElementById("nextBtn").innerHTML = "Próximo";
  }
}

function nextTab() {
  var tabcontent = document.getElementsByClassName("tab-content");
  var inputs = tabcontent[currentTab].getElementsByTagName("input");
  var valid = true;
  var emailInput;
  
  for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].type === "checkbox" && !inputs[i].checked) { 
      valid = false;
      break;
    } else if (inputs[i].name === "email") { 
      emailInput = inputs[i];
    } else if (inputs[i].value === "" || inputs[i].value === undefined) { 
      valid = false;
      break;
    }
  }
  
  if (emailInput && emailInput.type === "email" && !isValidEmail(emailInput.value)) {
    alert("Por favor, insira um endereço de email válido.");
  } else if (valid) {
    if (currentTab < tabcontent.length - 1) {
      currentTab++;
      showTab(currentTab);
    } else {
      var lastTabInputs = tabcontent[currentTab].getElementsByTagName("input");
      var checkBoxSelected = false;
      for (var j = 0; j < lastTabInputs.length; j++) {
        if (lastTabInputs[j].type === "checkbox" && lastTabInputs[j].checked) {
          checkBoxSelected = true;
          break;
        }
      }
      if (checkBoxSelected) {
        alert("Cadastro finalizado");
      } else {
        alert("Por favor, selecione o checkbox antes de prosseguir.");
      }
    }
  } else {
    alert("Verifique se todos os campos foram preenchidos!");
  }
}


function prevTab() {
  if (currentTab > 0) {
    currentTab--;
    showTab(currentTab);
  }
}

function isValidEmail(email) {
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailPattern.test(email);
}
