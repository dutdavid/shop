
<?php include('head.php');?>
<?php include('header.php');?>
<link rel="stylesheet" href="css/popup_style.css">



<?php include('sidebar.php');
if(isset($_GET['id']))
{ ?>

<div class="popup popup--icon -question js_question-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Sure
    </h1>
    <p>Are You Sure To Delete This Record?</p>
    <p>
      <a href="delete.php?id=<?php echo $_GET['id']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
      <a href="view.php" class="button button--error" data-for="js_success-popup">No</a>
    </p>
  </div>
</div>
<?php } ?>
  <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Stock Mobile</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Stock Mobile</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                
                <!-- /# row -->
                                        
                 <div class="col-14">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Stock Mobile Details</h4>
                                
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>store owner</th>
                                                <th>product</th>
                                                <th>quantity available</th>
                                                <th>sold</th>
                                                <th>date</th>
                                               <th>clear status</th>
                                               <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        </tfoot>
                                        <tbody>
                                        <?php
include 'include/db_connection.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 25;

$stmt = $pdo->prepare('SELECT * FROM stock_mobile ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$stock_mobile = $stmt->fetchAll(PDO::FETCH_ASSOC);

$num_contacts = $pdo->query('SELECT COUNT(*) FROM stock_mobile')->fetchColumn();
?>
                                            <?php foreach ($stock_mobile as $stock_mobile): ?>
            <tr>
                <td><?=$stock_mobile['id']?></td>
                <td><?=$stock_mobile['store_owner']?></td>
                <td><?=$stock_mobile['product']?></td>
                <td><?=$stock_mobile['quantity_available']?></td>
                <td><?=$stock_mobile['sold']?></td>
                <td><?=$stock_mobile['date']?></td>
				<td><?=$stock_mobile['clear_status']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$stock_mobile['id']?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>
                    <a href="view.php?id=<?=$stock_mobile['id']?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
                                         

                                        </tbody>
                                    </table>
                                  </form>
                                </div>
                            </div>
                        </div>
               
                <!-- /# row -->

                <!-- End PAge Content -->
           

<?php include('footer.php');?>

<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success 
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
      <button class="button button--success" data-for="js_success-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);  
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
      <button class="button button--error" data-for="js_error-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>