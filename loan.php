<?php
	date_default_timezone_set("Etc/GMT+8");
	require_once'session.php';
	require_once'class.php';
	$db=new db_class(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<style>
		input[type=number]::-webkit-inner-spin-button, 
		input[type=number]::-webkit-outer-spin-button{ 
			-webkit-appearance: none; 
		}

	</style>
	
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> Système De Gestion de Crédits</title>

    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  
   
    <link href="css/sb-admin-2.css" rel="stylesheet">
    
	<!-- Custom styles for this page -->
    <link href="css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="css/select2.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">Panneau D'administration</div>
            </a>


            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Accueil</span></a>
            </li>
			<li class="nav-item active">
                <a class="nav-link" href="loan.php">
                    <i class="fas fa-fw fas fa-comment-dollar"></i>
                    <span>Crédits</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="payment.php">
                    <i class="fas fa-fw fas fa-coins"></i>
                    <span>Paiements</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="borrower.php">
                    <i class="fas fa-fw fas fa-book"></i>
                    <span>Emprunteurs</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="loan_plan.php">
                    <i class="fas fa-fw fa-piggy-bank"></i>
                    <span> Plans Crédits</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="loan_type.php">
                    <i class="fas fa-fw fa-money-check"></i>
                    <span>Types Crédit</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="user.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Utilisateurs</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
	
                   
					<!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $db->user_acc($_SESSION['user_id'])?></span>
                                <img class="img-profile rounded-circle"
                                    src="image/admin_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
Deconnexion                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"> Liste de crédit </h1>
                    </div>
					<button class="mb-2 btn btn-lg btn-success" href="#" data-toggle="modal" data-target="#addModal"><span class="fa fa-plus"></span> Créer une nouvelle demande de prêt</button>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Emprunteurs</th>
                                            <th>Detail Crédit</th>
                                            <th>Detail Paiement </th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											$tbl_loan=$db->display_loan();
											$i=1;
											while($fetch=$tbl_loan->fetch_array()){
										?>
										
                                        <tr>
											<td><?php echo $i++;?></td>
											<td>
												<p><small>Nom: <strong><?php echo $fetch['lastname'].", ".$fetch['firstname']." ".substr($fetch['middlename'], 0, 1)."."?></strong></small></p>
												<p><small>N° Contact: <strong><?php echo $fetch['contact_no']?></strong></small></p>
												<p><small>Adresse: <strong><?php echo $fetch['address']?></strong></small></p>
											</td>
											<td>
												<p><small>Numero Reference : <strong><?php echo $fetch['ref_no']?></strong></small></p>
												<p><small>Type Crédit: <strong><?php echo $fetch['ltype_name']?></strong></small></p>
												<p><small> Plan crédit: <strong><?php echo $fetch['lplan_month']." mois[".$fetch['lplan_interest']."%, ".$fetch['lplan_penalty']."%]"?></strong> Intérêt, penalité</small></p>
												<?php
													$monthly =($fetch['amount'] + ($fetch['amount'] * ($fetch['lplan_interest']/100))) / $fetch['lplan_month'];
													$penalty=$monthly * ($fetch['lplan_penalty']/100);
													$totalAmount=$fetch['lplan_month']*$monthly;
												?>
												<p><small>Montant: <strong><?php echo number_format($fetch['amount'], 2)." "."€ "?></strong></small></p>
												<p><small>Montant total à payer: <strong><?php echo number_format($totalAmount, 2)." "."€ "?></strong></small></p>
												<p><small>Montant mensuel à payer: <strong><?php echo number_format($monthly, 2)." "."€ "?></strong></small></p>
												<p><small>Montant à payer en retard: <strong><?php echo number_format($penalty, 2)." "."€ "?></strong></small></p>
												<?php
													if (preg_match('/[1-9]/', $fetch['date_released'])){ 
														$date = date("d F Y", strtotime($fetch['date_released']));
$months = [
    'January' => 'janvier',
    'February' => 'fevrier',
    'March' => 'mars',
    'April' => 'avril',
    'May' => 'mai',
    'June' => 'juin',
    'July' => 'juillet',
    'August' => 'août',
    'September' => 'septembre',
    'October' => 'octobre',
    'November' => 'novembre',
    'December' => 'decembre'
];
$date = strtr($date, $months);
echo '<p><small>Date de déblocage: <strong><br>'.$date.'</strong></small></p>';
													}
												?>
												
											</td>
											<td>
												<?php
													$payment=$db->conn->query("SELECT * FROM `payment` WHERE `loan_id`='$fetch[loan_id]'") or die($this->conn->error);
													$paid = $payment->num_rows;
													$offset = $paid > 0 ? " offset $paid ": "";
													
													
												//debut ligne 195
													if($fetch['status'] == 2){
														$next = $db->conn->query("SELECT * FROM `loan_schedule` WHERE `loan_id`='$fetch[loan_id]' ORDER BY date(due_date) ASC limit 1 $offset ")->fetch_assoc();
if (is_null($next)) {
  echo"paiement de crédit terminé!";
} else {
    $next = $next['due_date'];
} //fin ligne 195
														$add = (date('Ymd',strtotime($next)) < date("Ymd") ) ?  $penalty : 0;
														$date = date('d F, Y',strtotime($next));
$months = [
    'January' => 'janvier',
    'February' => 'fevrier',
    'March' => 'mars',
    'April' => 'avril',
    'May' => 'mai',
    'June' => 'juin',
    'July' => 'juillet',
    'August' => 'aout',
    'September' => 'septembre',
    'October' => 'octobre',
    'November' => 'novembre',
    'December' => 'decembre'
];
$date = strtr($date, $months);
echo "<p><small>Prochaine date de paiement: <br /><strong>".$date."</strong></small></p>";
														echo "<p><small>Montant mensuel: <br /><strong> ".number_format($monthly, 2)." €</strong></small></p>";
														echo "<p><small>Penalité: <br /><strong> ".$add." €</strong></small></p>";
														echo "<p><small>Montant à payer: <br /><strong>".number_format($monthly+$add, 2)."
														€</strong></small></p>";
													}
												?>
											</td>
											<td>
												<?php 
													if($fetch['status']==0){
														echo '<span class="badge badge-warning">pour Approbation</span>';
													}else if($fetch['status']==1){
														echo '<span class="badge badge-info">Approuvé</span>';
													}else if($fetch['status']==2){
														echo '<span class="badge badge-primary">debloqué</span>';
													}else if($fetch['status']==3){
														echo '<span class="badge badge-success">achevé</span>';
													}else if($fetch['status']==4){
														echo '<span class="badge badge-danger">Refusé</span>';
													}
													
												?>
											</td>
                                            <td>
												<?php 
													if($fetch['status']==2){
												?>
													<button class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#viewSchedule<?php echo $fetch['loan_id']?>">Voir le calendrier des paiements</button>
												<?php
													}else if($fetch['status']==3){
												?>
													<button class="btn btn-lg btn-success" readonly="readonly">Achevé</button>
												<?php
													}else{
												?>
													<div class="dropdown">
														<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															Action
														</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
															<a class="dropdown-item bg-warning text-white" href="#" data-toggle="modal" data-target="#updateloan<?php echo $fetch['loan_id']?>">Modifier</a>
															<a class="dropdown-item bg-danger text-white" href="#" data-toggle="modal" data-target="#deleteborrower<?php echo $fetch['loan_id']?>">Supprimer</a>
														</div>
													</div>
												<?php
													}
												?>
											</td>
                                        </tr>
										
										
										<!-- Update User Modal -->
										<div class="modal fade" id="updateloan<?php echo $fetch['loan_id']?>" aria-hidden="true">
											<div class="modal-dialog modal-lg">
												<form method="POST" action="updateLoan.php">
													<div class="modal-content">
														<div class="modal-header bg-warning">
															<h5 class="modal-title text-white">Modifier Crédit</h5>
															<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">×</span>
															</button>
														</div>
														<div class="modal-body">
															<div class="form-row">
																<div class="form-group col-xl-6 col-md-6">
																	<label>Emprunteur</label>
																	<br />
																	<input type="hidden" value="<?php echo $fetch['loan_id']?>" name="loan_id"/>
																	<select name="borrower" class="borrow" required="required" style="width:100%;">
																		<?php
																			$tbl_borrower=$db->display_borrower();
																			while($row=$tbl_borrower->fetch_array()){
																		?>
																			<option value="<?php echo $row['borrower_id']?>" <?php echo ($fetch['borrower_id']==$row['borrower_id'])?'selected':''?>><?php echo $row['lastname'].", ".$row['firstname']." ".substr($row['middlename'], 0, 1)?>.</option>
																		<?php
																			}
																		?>
																	</select>
																</div>
																<div class="form-group col-xl-6 col-md-6">
																	<label> type crédit</label>
																	<br />
																	<select name="ltype" class="loan" required="required" style="width:100%;">
																		<?php
																			$tbl_ltype=$db->display_ltype();
																			while($row=$tbl_ltype->fetch_array()){
																		?>
																			<option value="<?php echo $row['ltype_id']?>" <?php echo ($fetch['ltype_id']==$row['ltype_id'])?'selected':''?>><?php echo $row['ltype_name']?></option>
																		<?php
																			}
																		?>
																	</select>
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col-xl-6 col-md-6">
																	<label> Plan crédit</label>
																	<select name="lplan" class="form-control" required="required" id="ulplan">
																		<?php
																			$tbl_lplan=$db->display_lplan();
																			while($row=$tbl_lplan->fetch_array()){
																		?>
																			<option value="<?php echo $row['lplan_id']?>" <?php echo ($fetch['lplan_id']==$row['lplan_id'])?'selected':''?>><?php echo $row['lplan_month']." months[".$row['lplan_interest']."%, ".$row['lplan_penalty']."%]"?></option>
																		<?php
																			}
																		?>
																	</select>
																	<label>Mois[Interet%, Penalité%]</label>
																</div>
																<div class="form-group col-xl-6 col-md-6">
																	<label>Montant crédit</label>
																	<input type="number" name="loan_amount" class="form-control" id="uamount" value="<?php echo $fetch['amount']?>" required="required"/>
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col-xl-6 col-md-6">
																	<label>objectif</label>
																	<textarea name="purpose" class="form-control" style="resize:none; height:200px;" required="required"><?php echo $fetch['purpose']?></textarea>
																</div>
																<div class="form-group col-xl-6 col-md-6">
																	<button type="button" class="btn btn-primary btn-block" id="updateCalculate">Calculer Montant</button>
																</div>
															</div>
															<hr>
															<div class="row">
																<div class="col-xl-4 col-md-4">
																	<center><span>Montant total à payer</span></center>
																	<center><span id="utpa"><?php echo "€ ".number_format($totalAmount, 2)?></span></center>
																</div>
																<div class="col-xl-4 col-md-4">

																	<center><span>Montant mensuel à payer</span></center>
																	<center><span id="umpa"><?php echo "€ ".number_format($monthly, 2)?></span></center>
																</div>
																<center><span>Montant  penalité</span></center>
																<div class="col-xl-4 col-md-4">
																	<center><span id="upa"><?php echo number_format($penalty, 2)." "."€ ";?></span></center>
																</div>
															</div>
															<hr>
															<div class="form-row">
																<div class="form-group col-xl-6 col-md-6">
																	<label>Status</label>
																	<select class="form-control" name="status">
																		<?php
																			if($fetch['status']==4){
																		?>
																			<option value="0" <?php echo ($fetch['status']==0)?'selected':''?>>pour approbation</option>
																			<option value="1" <?php echo ($fetch['status']==1)?'selected':''?>>Approuvé</option>
																			<option value="4" <?php echo ($fetch['status']==4)?'selected':''?>>Refusé</option>
																		<?php
																			}else if($fetch['status']==2){
																		?>
																			<option value="2" readonly="readonly">Liberé</option>
																		<?php
																			}else{
																		?>
																			<option value="0" <?php echo ($fetch['status']==0)?'selected':''?>>pour approbation</option>
																			<option value="1" <?php echo ($fetch['status']==1)?'selected':''?>>Approuvé</option>
																			<option value="2" <?php echo ($fetch['status']==2)?'selected':''?>>Debloqué</option>
																			<option value="4" <?php echo ($fetch['status']==4)?'selected':''?>>Refusé</option>
																		<?php
																			}
																		?>
																	</select>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
															<button type="submit" name="update" class="btn btn-warning">Modifier</a>
														</div>
													</div>
												</form>
											</div>
										</div>
										
										
										
										<!-- Delete Loan Modal -->
										
										<div class="modal fade" id="deleteborrower<?php echo $fetch['loan_id']?>" tabindex="-1" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header bg-danger">
														<h5 class="modal-title text-white">Systeme D'Information</h5>
														<button class="close" type="button" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
													</div>
													<div class="modal-body">Êtes-vous sûr de vouloir supprimer cet enregistrement?</div>
													<div class="modal-footer">
														<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
														<a class="btn btn-danger" href="deleteLoan.php?loan_id=<?php echo $fetch['loan_id']?>">Supprimer</a>
													</div>
												</div>
											</div>
										</div>
										
										<!-- View Payment Schedule -->
										<div class="modal fade" id="viewSchedule<?php echo $fetch['loan_id']?>" tabindex="-1" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header bg-info">
														<h5 class="modal-title text-white">Calendrier des paiements</h5>
														<button class="close" type="button" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
													</div>
													<div class="modal-body">
														<div class="row">
															<div class="col-md-5 col-xl-5">
																<p>N° de référence:</p>
																<p><strong><?php echo $fetch['ref_no']?></strong></p>
															</div>
															<div class="col-md-7 col-xl-7">
																<p>Nom:</p>
																<p><strong><?php echo $fetch['firstname']." ".substr($fetch['middlename'], 0, 1).". ".$fetch['lastname']?></strong></p>
															</div>
														</div>
														<hr />
														
														<div class="container">
															<div class="row">
																<div class="col-sm-6"><center>Mois</center></div>
																<div class="col-sm-6"><center>Paiement mensuel</center></div>
															</div>
															<hr />
															<?php 
																$tbl_schedule=$db->conn->query("SELECT * FROM `loan_schedule` WHERE `loan_id`='".$fetch['loan_id']."'");
																
																while($row=$tbl_schedule->fetch_array()){
															?>
															<div class="row">
																<div class="col-sm-6 p-2 pl-5" style="border-right: 1px solid black; border-bottom: 1px solid black;"><strong><?php setlocale(LC_TIME, 'fr_FR', 'fra');
                                                                 echo strftime('%d %B %Y', strtotime($row['due_date']));?></strong></div>
																<div class="col-sm-6 p-2 pl-7" style="border-bottom: 1px solid black;"><strong><?php echo number_format($monthly, 2)." "."€ "; ?></strong></div>
															</div>
																<?php
																}
															?>
														
														</div>	
													</div>
													<div class="modal-footer">
														<button class="btn btn-secondary" type="button" data-dismiss="modal">Fermer</button>
													</div>
												</div>
											</div>
										</div>
										
										
										
										
										<?php
											}
										?>
                                    </tbody>
                                </table>
                            </div>
						</div>
                       
                    </div>
				</div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="stocky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;  Systeme De Gestion De crédits <?php echo date("Y")?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
	
	
	<!-- Add Loan Modal-->
	<div class="modal fade" id="addModal" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<form method="POST" action="save_loan.php">
				<div class="modal-content">
					<div class="modal-header bg-primary">
						<h5 class="modal-title text-white"> Application De crédits bancaires</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-xl-6 col-md-6">
								<label>Emprunteur</label>
								<br />
								<select name="borrower" class="borrow" required="required" style="width:100%;">
									<option value=""></option>
									<?php
										$tbl_borrower=$db->display_borrower();
										while($fetch=$tbl_borrower->fetch_array()){
									?>
										<option value="<?php echo $fetch['borrower_id']?>"><?php echo $fetch['lastname'].", ".$fetch['firstname']." ".substr($fetch['middlename'], 0, 1)?>.</option>
									<?php
										}
									?>
								</select>
							</div>
							<div class="form-group col-xl-6 col-md-6">
								<label> type Crédit</label>
								<br />
								<select name="ltype" class="loan" required="required" style="width:100%;">
										<option value=""></option>
									<?php
										$tbl_ltype=$db->display_ltype();
										while($fetch=$tbl_ltype->fetch_array()){
									?>
										<option value="<?php echo $fetch['ltype_id']?>"><?php echo $fetch['ltype_name']?></option>
									<?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-xl-6 col-md-6">
								<label> Plan crédit</label>
								<select name="lplan" class="form-control" required="required" id="lplan">
										<option value="">Veuillez sélectionner une option</option>
									<?php
										$tbl_lplan=$db->display_lplan();
										while($fetch=$tbl_lplan->fetch_array()){
									?>
										<option value="<?php echo $fetch['lplan_id']?>"><?php echo $fetch['lplan_month']."mois[".$fetch['lplan_interest']."%, ".$fetch['lplan_penalty']."%]"?></option>
									<?php
										}
									?>
								</select>
								<label>Mois[Interet%, Penalité%]</label>
							</div>
							<div class="form-group col-xl-6 col-md-6">
								<label>Montant crédit</label>
								<input type="number" name="loan_amount" class="form-control" id="amount" required="required"/>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-xl-6 col-md-6">
								<label>Objectif</label>
								<textarea name="purpose" class="form-control" style="resize:none; height:200px;" required="required"></textarea>
							</div>
							<div class="form-group col-xl-6 col-md-6">
								<button type="button" class="btn btn-primary btn-block" id="calculate">Calculer le montant</button>
							</div>
						</div>
						<hr>
						<div class="row" id="calcTable">
							<div class="col-xl-4 col-md-4">
								<center><span>Montant total à payer</span></center>
								<center><span id="tpa"></span></center>
							</div>
							<div class="col-xl-4 col-md-4">
								<center><span>Montant mensuel à payer</span></center>
								<center><span id="mpa"></span></center>
							</div>
							<div class="col-xl-4 col-md-4">
								<center><span>Montant  pénalité</span></center>
								<center><span id="pa"></span></center>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
						<button type="submit" name="apply" class="btn btn-primary">Appliquer</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	
	
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Systeme D'Information</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Êtes-vous sûr de vouloir vous déconnecter?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <a class="btn btn-danger" href="logout.php">Deconnexion</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.bundle.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="js/jquery.easing.js"></script>
    <script src="js/select2.js"></script>


	<!-- Page level plugins -->
	<script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap4.js"></script>
	

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>
	
	<script>
		
		$(document).ready(function() {
			$("#calcTable").hide();
			
			
			$('.borrow').select2({
				placeholder: 'Selectionner une option'
			});
			
			$('.loan').select2({
				placeholder: 'Selectionner une option'
			});
			
			
			
			$("#calculate").click(function(){
				if($("#lplan").val() == "" || $("#amount").val() == ""){
					alert("Veuillez saisir un plan de crédit ou un montant à calculer")
				}else{
					var lplan=$("#lplan option:selected").text();
					var months=parseFloat(lplan.split('months')[0]);
					var splitter=lplan.split('months')[1];
					var findinterest=splitter.split('%')[0];
					var interest=parseFloat(findinterest.replace(/[^0-9.]/g, ""));
					var findpenalty=splitter.split('%')[1];
					var penalty=parseFloat(findpenalty.replace(/[^0-9.]/g, ""));
					
					var amount=parseFloat($("#amount").val());
					
					var monthly =(amount + (amount * (interest/100))) / months;
					var penalty=monthly * (penalty/100);
					var totalAmount=monthly*months;
					
					
					
					$("#tpa").text("\u20B1 "+totalAmount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2}));
					$("#mpa").text("\u20B1 "+monthly.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2}));
					$("#pa").text("\u20B1 "+penalty.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2}));
					
					$("#calcTable").show();
				}
				
			});
			
			
			$("#updateCalculate").click(function(){
				if($("#ulplan").val() == "" || $("#uamount").val() == ""){
					alert("Veuillez saisir un plan de crédit ou un montant à calculer")
				}else{
					var lplan=$("#ulplan option:selected").text();
					var months=parseFloat(lplan.split('months')[0]);
					var splitter=lplan.split('months')[1];
					var findinterest=splitter.split('%')[0];
					var interest=parseFloat(findinterest.replace(/[^0-9.]/g, ""));
					var findpenalty=splitter.split('%')[1];
					var penalty=parseFloat(findpenalty.replace(/[^0-9.]/g, ""));
					
					var amount=parseFloat($("#uamount").val());
					
					var monthly =(amount + (amount * (interest/100))) / months;
					var penalty=monthly * (penalty/100);
					var totalAmount=monthly*months;
					
					
					
					$("#utpa").text("\u20B1 "+totalAmount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2}));
					$("#umpa").text("\u20B1 "+monthly.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2}));
					$("#upa").text("\u20B1 "+penalty.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2}));
					

				}
				
			});
			
			$('#dataTable').DataTable();
		});
	</script>

</body>

</html>