$(document).ready(function() {
  //DISPLAYING ITEM ON THE DASHBOARD
  $("#itemform").on("submit", function(e) {
    e.preventDefault();
    let allItems = "";
    let item = $("#item").val();
    let priority = $("#priority").val();
    let insideTable = $("#insideTable");

    allItems += ` <tr>
    <td class="text-capitalize"><b id="itemRow">${item}</b></td>
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
  let tableid = document.getElementById("tableid");
  let tableRow = tableid.rows.length;
  if (tableRow > 1) {
    for (let i = 0; i < tableRow; i++) {
      let clickedBtn = tableid.rows[i].cells[0].childNodes[0];
      console.log(clickedBtn);
      if (clickedBtn.click) {
        tableid.deleteRow(i);
        tableid--;
      }
    }
  }
}

// CALCULATE BUTTON FUNCTION
function calculate() {
  let table = document.getElementById("tableid");
  let tableRows = table.rows.length;
  let priority = $("#priorityRow").html();

  let budgetedamount = $("#budgetedamount").val();
  let alert = "";
  if (tableRows < 2 || budgetedamount == "") {
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

    $("#myAlert").html(alert);

    setTimeout(() => {
      $(".alert").alert("close");
    }, 3000);
  } else {
    if (priority == "Very High") {
      let theamsedata = $("#tableid tr > td:contains(Very High)").length;
      if (theamsedata > 1) {
        alert = `<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
              <strong>Error!</strong>  You can not have the same Priority.
              <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>`;

        $("#myAlert").html(alert);
        setTimeout(() => {
          $(".alert").alert("close");
        }, 3000);
      } else {
        amount = (40 / 100) * budgetedamount;
        $("#amount").html(amount);
      }
    } else if (priority == "High") {
      let theamsedata = $("#tableid tr > td:contains(High)").length;
      if (theamsedata > 1) {
        alert = `<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <strong>Error!</strong>  You can not have the same Priority.
        <button
          type="button"
          class="close"
          data-dismiss="alert"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>`;

        $("#myAlert").html(alert);
        setTimeout(() => {
          $(".alert").alert("close");
        }, 3000);
      } else {
        amount = (30 / 100) * budgetedamount;
        $("#amount").html(amount);
      }
    } else if (priority == "Low") {
      let theamsedata = $("#tableid tr > td:contains(Low)").length;
      if (theamsedata > 1) {
        alert = `<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <strong>Error!</strong>  You can not have thesame Priolity.
        <button
          type="button"
          class="close"
          data-dismiss="alert"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>`;

        $("#myAlert").html(alert);
        setTimeout(() => {
          $(".alert").alert("close");
        }, 3000);
      } else {
        amount = (20 / 100) * budgetedamount;
        $("#amount").html(amount);
      }
    } else if (priority == "Very Low") {
      let theamsedata = $("#tableid tr > td:contains(Very Low)").length;
      if (theamsedata > 1) {
        alert = `<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <strong>Error!</strong>  You can not have thesame Priolity.
        <button
          type="button"
          class="close"
          data-dismiss="alert"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>`;

        $("#myAlert").html(alert);
        setTimeout(() => {
          $(".alert").alert("close");
        }, 3000);
      } else {
        amount = (10 / 100) * budgetedamount;
        $("#amount").html(amount);
      }
    }
  }
}

function saveBudget() {
  let category = $("#category").val();
  let alert = "";
  let item = $("#itemRow").html();
  let priority = $("#priorityRow").html();
  let amount = $("#amount").html();
  let total = $("#budgetedamount").val();
  let data = { item, amount, priority, category, total };

  if (category == "" || item == null || priority == null || total == "") {
    alert = `<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
    <strong>Error!</strong>  Select categories, Enter Items and total sum before you save.
    <button
      type="button"
      class="close"
      data-dismiss="alert"
      aria-label="Close"
    >
      <span aria-hidden="true">&times;</span>
    </button>
  </div>`;

    $("#myAlert").html(alert);
    setTimeout(() => {
      $(".alert").alert("close");
    }, 3000);
  } else {
    $.ajax({
      method: "POST",
      url: "budget-save.php",
      data: data,
      success: function(result) {
        console.log(result);
      }
    });
  }
}

function display() {
  let category = $("#category").val();
  let total = $("#budgetedamount");
  $.ajax({
    method: "GET",
    url: "budget-get.php",
    data: { category },
    success: function(result) {
      let insideTable = $("#insideTable");
      let myData = "";
      console.log(result);

      for (const key in result) {
        const element = result[key];

        myData = `<tr>
        <td class="text-capitalize"><b id="itemRow">${element.item}</b></td>
        <td class="text-capitalize"><b id="amount">${element.amount}</b></td>
          <td class="text-capitalize"><b id="priorityRow">${element.priority}</b></td>
          <td>
            <button class="btn btn-danger" id ="deleteBtn" name="deleteBtn" onclick="deleted()">
              <i class="fas fa-trash-alt"></i>
            </button>
          </td>
        </tr>`;

        insideTable.html(myData);
        insideTable.val(element.total);
      }
    }
  });
}
