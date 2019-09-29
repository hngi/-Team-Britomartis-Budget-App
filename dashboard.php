<?php 
include('phpInc/login.php');

userAuth();

logOut();

$dName = $_SESSION['name'];
$dEmail = $_SESSION['email'];
$dCurrency = $_SESSION['currency'];
$currency = '';
if ($dCurrency == 'NGN') {
  $currency = '&#8358;';
} else {
  $currency = '&#36;';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>go-budget</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/dashboard.css" />
    <link rel="stylesheet" href="./css/all.min.css" />
    <link rel="stylesheet" href="./css/fontawesome.min.css" />
  </head>
  <body>
    <section class="">
    <div class="row ">
      <div class="col-3">
        <form action="" method="POST">
            <button class="btn btn-danger" name="logout">Log Out</button>
        </form>
      </div>
      <!-- <div class="col-6">
        <button class="btn btn-primary" name="myBudget">
          Display Budget
        </button>
      </div>
      <div class="col-3">
        <button
          class="btn btn-success"
          name="myBudget"
          onclick="saveBudget()"
        >
          Save Budget
        </button>
      </div> -->
    </div>
    </section>
    <section class="mt-4 text-center container">
      
      <h4 class="text-white"><b> Welcome <?= $dName; ?></b></h4>
    </section>
    <section class="mainbody">
      <div id="myAlert"></div>
      <div class="container my-2">
        <div class="row ">
          <div class="col-4"><img src="./img/blue_logo.png" alt="" /></div>
        </div>
      </div>
      <div class="container">
        <table class="table table-hover table-responsive" id="tableid">
          <thead>
            <tr>
              <th scope="col"><h5>Item</h5></th>  
              <th scope="col"><h5>Category</h5></th>
              <th scope="col"><h5>Amount</h5></th>
              <th scope="col"><h5>Priority</h5></th>
              <th scope="col"><h5>Delete</h5></th>
            </tr>
          </thead>
          <tbody id="insideTable"></tbody>
        </table>
        <div class="row mt-4 down-text">
          <div class="col-sm-12 col-md-6">
            <p>
              <b>
                Enter Total Available Sum
                
                <input
                  class="form-control mytotal text-center"
                  type="number"
                  name="budgetedamount"
                  id="budgetedamount"
                  placeholder="<?= $currency ?>"
                  value=""
                />
              </b>
            </p>
          </div>

          <div class="col-sm-12 col-md-3">
            <button
              class="btn btn-primary p-3 px-4 mybutton"
              data-toggle="modal"
              data-target="#loginModal"
            >
              <b class="btnText">
                +
              </b>
            </button>

            <!-- Modal -->
            <div
              class="modal fade"
              id="loginModal"
              tabindex="-1"
              role="dialog"
              aria-labelledby="loginModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-body text-center">
                    <form method="POST" id="itemform">
                      <fieldset>
                        <legend>
                          <img src="./img/blue_logo.png" alt="Budget logo" />
                        </legend>
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="item"
                            id="item"
                            placeholder="Enter Item"
                            required
                          />
                        </div>
                        <div class="form-group">
                          <select name="category"
                           id="category" 
                           class="form-control"
                           required
                          >
                            <option value="">Category</option>
                            <option value="Transportation">Transportation</option>
                            <option value="Housing">Housing</option>
                            <option value="Food">Food</option>
                            <option value="Personal Care">Personal Care</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <select
                            name="priority"
                            id="priority"
                            class="form-control"
                            required
                          >
                            <option value="">Priority</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                          </select>
                        </div>
                        <button class="btn btn-primary" id="enterBtn">
                          Enter
                        </button>
                      </fieldset>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-3">
            <button class="btn btn-primary btn-cal" onclick="calculate()">
              Calculate
            </button>
          </div>
        </div>
      </div>
    </section>

    <!--SCRIPTS-->
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/dashboard.js"></script>
  </body>
</html>
