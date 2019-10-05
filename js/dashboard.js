//Declare a global variable for holding the value in the amount input field
let globalAmountArray = [];
//declare a global variable to hold a boolean value to test which input field was change
let golbalTestArray = [];

$(document).ready(function() {
    //DISPLAYING ITEM ON THE DASHBOARD
  $("#itemform").on("submit", function(e) {
    e.preventDefault();
    let allItems = "";
    let item = $("#item").val();
    let priority = $("#priority").val();
    let category = $("#category").val();
    let insideTable = $("#insideTable");

    allItems = ` <tr id="itemObj">
    <td class="text-capitalize"><b id="itemRow">${item}</b></td>
    <td class="text-capitalize"><b id="categoryRow">${category}</b></td>
    <td class="text-capitalize"><input onkeyup="testInput(this, this.value)" id="amount" type="text" value="0" min="0" size="4" /></td>
      <td class="text-capitalize"><b id="priorityRow">${priority}</b></td>
  
 <td>
        <button class="btn btn-danger" id ="deleteBtn" name="deleteBtn" onclick="deleted()">
          <i class="fas fa-trash-alt"></i>
        </button>
      </td>
    </tr>`;

    insideTable.append(allItems);
    globalAmountArray.push(0);
    golbalTestArray.push(false);

    $("#itemform")[0].reset();
  });
});

// DELETE BUTTON FUNCTION
function deleted() {
  const deleteBtn = document.querySelector('#deleteBtn');
  const deteleRow = deleteBtn.parentElement.parentElement;
  deteleRow.remove();
  
  
  // if (tableRow > 1) {
  //   for (let i = 0; i < tableRow; i++) {
  //     let clickedBtn = tableid.rows[i].cells[0].childNodes[0];
  //     console.log(clickedBtn);
  //     if (clickedBtn.click) {
  //       tableid.deleteRow(i);
  //       tableid--;
  //     }
  //   }
  // }
}

// CALCULATE BUTTON FUNCTION
function calculate() {
  // let table = document.getElementById("tableid");
  // let tableRows = table.rows.length;
  let budgetedAmount = document.querySelector('#budgetedamount').value;

  const items = document.querySelectorAll('#itemObj');
  if (items.length == 0 || budgetedAmount == "") {
    alert = `<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
    <strong>Error!</strong>  Items Rows or Enter Total Available Sum cannot be empty.
    <button
      type="button"
      class="close"
      data-dismiss="alert"
      aria-label="Close"
    >
      <span aria-hidden="true">&times;</span>
    </button>
  </div>`;

  $('#myAlert').html(alert);

  setTimeout(() => {
    $('.alert').remove();
  }, 3000);
  
  } 
  else {
    
    const prioArr = [];
    const budgetedAmount = document.querySelector('#budgetedamount');
    
    const priorities = document.querySelectorAll('#priorityRow').values();
    const amountRow = document.querySelectorAll('#amount');
    for (let prior of priorities) {
      let priority = prior.innerText;
      
      if (priority == 'Low') {
        priority = 1;
        prioArr.push(priority);
      }

      if (priority == 'Medium') {
        priority = 2;
        prioArr.push(priority);
      }

      if (priority == 'High') {
        priority = 3;
        prioArr.push(priority);
      } 
    }
    console.log(prioArr);
    console.log(budgetedAmount.value);

    const prioritySum = prioArr.reduce((a, b) => (a + b), 0); 

    console.log(prioritySum);
    
    let amount;

    //get the input fields that were changed
    for (let i = 0; i < prioArr.length; i++) {
      if(globalAmountArray[i] !== Number.parseFloat(amountRow[i].value)){
        golbalTestArray[i] = true;
      }
    }

    //get the sum of the priorities needed and the total fixed amount
    let sum = 0;
    let totalFixedAmount = 0;
    for (let i = 0; i < prioArr.length; i++) {
      if(golbalTestArray[i]){
        totalFixedAmount += Number.parseFloat(amountRow[i].value);
        continue;
      }
      sum += prioArr[i];
    }

    if(sumAmount() <= budgetedAmount.value){
      //insert the values to their designated input fields
      for (let i = 0; i < prioArr.length; i++) {
        //check if the value does not need to be changed
        if(golbalTestArray[i]){
          //update the previous amount array
          globalAmountArray[i] = Number.parseFloat(amountRow[i].value);
          //update the test array back to false
          golbalTestArray[i] = false;
          continue;
        }
        amount = (prioArr[i] / sum) * (budgetedAmount.value - totalFixedAmount); 
        amountRow[i].value = Math.round(amount * 100) / 100;

        //update the previous amount array
        globalAmountArray[i] = Number.parseFloat(amountRow[i].value);
        //update the test array back to false
        golbalTestArray[i] = false;
      }
      return;
    }
    if(sumAmount() == 0){
      for (let i = 0; i < prioArr.length; i++) {
        amount = (prioArr[i] / prioritySum) * budgetedAmount.value
        console.log(Math.round(amount * 100) / 100);
        amountRow[i].value = Math.round(amount * 100) / 100;
        globalAmountArray[i] = Number.parseFloat(amountRow[i].value);
      }
    }else{
      if(totalFixedAmount > budgetedAmount.value){
        for (let i = 0; i < prioArr.length; i++) {
          amountRow[i].value = 0;
          //update the previous amount array
          globalAmountArray[i] = Number.parseFloat(amountRow[i].value);
          //update the test array back to false
          golbalTestArray[i] = false;
        }
  
        let alert = `<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                      <strong>Error!</strong> Entered Item(s) greater than Budgeted Amount!
                      <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-label="Close"
                      >
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>`;
    
        $('#myAlert').html(alert);
    
        setTimeout(() => {
          $('.alert').remove();
        }, 3000);

        return;
      }else{
        //insert the values to their designated input fields
        for (let i = 0; i < prioArr.length; i++) {
          //check if the value does not need to be changed
          if(golbalTestArray[i]){
            //update the previous amount array
            globalAmountArray[i] = Number.parseFloat(amountRow[i].value);
            //update the test array back to false
            golbalTestArray[i] = false;
            continue;
          }
          amount = (prioArr[i] / sum) * (budgetedAmount.value - totalFixedAmount); 
          amountRow[i].value = Math.round(amount * 100) / 100;

          //update the previous amount array
          globalAmountArray[i] = Number.parseFloat(amountRow[i].value);
          //update the test array back to false
          golbalTestArray[i] = false;
        }
      }
    }
  }
}

//This function is used to sum all the amount 
function sumAmount(){
  const amountRow = document.querySelectorAll('#amount');
  let sum = 0;

  for (let i = 0; i < amountRow.length; i++) {
    let item = Number.parseFloat(amountRow[i].value) || 0;
    sum += item;
  }

  return sum;
}

//This function is used to edit the user input as necessary
function testInput(element, value){
  if (Number.isNaN(Number.parseFloat(value))) {
    if(value == ""){
      element.value = 0;
      return;
    }
      element.value.charAt(value.length - 1) = "";
      return;
  }else{
    element.value = Number.parseFloat(value);
  }

}
