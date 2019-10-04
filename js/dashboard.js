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
    <td class="text-capitalize"><b id="amount"></b></td>
      <td class="text-capitalize"><b id="priorityRow">${priority}</b></td>
      <td>
        <button class="btn btn-danger" id ="deleteBtn" name="deleteBtn" onclick="deleted()">
          <i class="fas fa-trash-alt"></i>
        </button>
      </td>
    </tr>`;

    insideTable.append(allItems);

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
  const items = document.querySelectorAll('#itemObj');
  if (items.length == 0 || budgetedamount == "") {
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

    document.querySelector('#myAlert').innerHTML(alert);

    setTimeout(() => {
      document.querySelector('.alert').alert("close");
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

    for (let i = 0; i < prioArr.length; i++) {
      amount = (prioArr[i] / prioritySum) * budgetedAmount.value
      console.log(Math.round(amount * 100) / 100);
      amountRow[i].innerText = Math.round(amount * 100) / 100;
    }

  }

}