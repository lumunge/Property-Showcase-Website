<?php

                  if (isset($_POST['sendBtn'])){
									if (empty($_POST['date'])){
										$sweet='error';
										$feedback='Error: Please enter a date';
									}else{
									$hiddenID=$_POST['id'];
									$date=$_POST['date'];
									$update="UPDATE `booked_apartments` SET `vacate_date`='$date',`vacation_status`='Intend to vacate' WHERE `id`='$hiddenID' ";
									if (mysqli_query($conn,$update)){
										$sweet='success';
									 $feedback="Notice to vacate sent";
										
									}
										
								}
								}
?>