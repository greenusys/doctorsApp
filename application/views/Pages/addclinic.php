

<script>
        $(document).ready(function(){
          $('#countryIds').on('change',function(){
            var countryid=$(this).val();
            //  alert(countryid);
            $.ajax({
              url:"<?=base_url('Doctors/get_States')?>",
              type:"post",
              data:{countryid:countryid},
              success:function(response)
              {
                //   console.log(response.data);
                  response=JSON.parse(response);
                    // console.log(response);
                  if(response.code==1)
                  {
                    
                    for (var i = 0; i <response.data.length; i++) 
                    {
                        var html;
                        // console.log(response.data[i].name);
                        html+='<option value="'+response.data[i].states_id+'">'+response.data[i].name+'</option>';
                        // html+="<option value="'+response.data[i].id+'">" + response.data[i].name + "</option>";
                       
                        $('#stateId').append(html);
                    }
                }
                else
                  {
                      
                  }
                  
              }
                  
              });
            })
          })
       
      </script>
       <script>
        $(document).ready(function(){
          $('#stateId').on('change',function(){
            var stateId=$(this).val();
            // alert(stateId);
            $.ajax({
              url:"<?=base_url('Doctors/get_Cities')?>",
              type:"post",
              data:{stateId:stateId},
              success:function(response)
              {
                //   console.log(response.data);
                  response=JSON.parse(response);
                    // console.log(response);
                  if(response.code==1)
                  {
                    
                   for (var i = 0; i <response.data.length; i++) 
                    {
                        var html;
                        
                        html+='<option value="'+response.data[i].cities_id+'">'+response.data[i].name+'</option>';
                       
                       
                        $('#cityId').append(html);
                    }
                }
                else
                  {
                    //   html+="<option>" + response.data[i].name + "</option>";
                       
                    //     $('#stateId').append(html);
                  }
                  
              }
                  
              });
            })
          })
       
	
		  var doc=[];
		   $(document).on('change','.pushpop',function()
		   {   
				if(this.checked)
				{   
					doc.push($(this).val());
					// doc.push($(this).val());
						// $(".pushpop").attr('disabled', true);
							// $(this).attr('disabled',false);

					}
					else
					{
						// $(".sunday").attr('disabled',true);
						doc.pop($(this).val());
						// $(".pushpop").attr('disabled',false);
					}
			});
        $(document).ready(function(){
			$(".doctorsss").hide();
          $('#categoryid').on('change',function(){
            var category_id=$(this).val();
            //  alert(category_id);
            $.ajax({
              url:"<?=base_url('Clinic/fetchDoctorsByCat')?>",
              type:"post",
              data:{category_id:category_id},

             success:function(response)
               {
				   console.log(response)
                response=JSON.parse(response);
				$('#checkboxes').empty();
				if(response.code==1)
				{

					for(let i=0; i<response.data.length; i++)
					{
						var chk='';
						chk+='<input type="checkbox" class="pushpop"  value="'+response.data[i].doc_id+'" name="doc[]"> '+response.data[i].doc_fname+' '+response.data[i].doc_lname;'</br>'
						//console.log(chk);
						$('#checkboxes').append(chk);

					}
					$(".doctorsss").show();
				}
				else{
					
					
						
				}
				//  console.log(response.results);

                // $(".docfname").val(response.doc_fname);
                // $(".doclname").val(response.doc_lname);
              }     
              });
            });
          });
		 
	  </script>
	
<div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Clinic  </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
					<?php
              if($this->session->flashdata('msg'))
              {
                echo '<div class="alert alert-info">'.$this->session->flashdata('msg').'</div>';
              }
            ?>
                        <form action="<?=base_url('Clinic/add_Clinic')?>" method="post" enctype="multipart/form-data">
						<div class="form-group">
                                <label><strong>Category</strong></label>
								<select  class="countries order-alpha input-style form-control " autocomplete="false" required name="cliniccategoryid" id="categoryid">
						<option value="">Select Category</option>
						<?php
                      foreach ($fetchCategories as $cat) 
                      {
                        echo '<option value="'.$cat->cat_id.'">'.$cat->cat_name.'</option>';
            
                      }
                      ?>  
					</select>
							</div>

							<div class="form-group doctorsss">
                                <label><strong>Doctors </strong></label>
								<div id="checkboxes">
									
								</div>
							</div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label><strong>Clinic Name</strong> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" required name="clinicname">
                                    </div>
                                </div>
                                <div class="col-sm-6">
								<div class="form-group">
                                        <label><strong>Clinic Email</strong> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" required name="clinicemail">
                                    </div>
                                   
								</div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label><strong>Open Time</strong> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="time" required name="opentime">
                                    </div>
								</div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label><strong>Closed Time</strong> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="time" required name="closetime">
                                    </div>
                                </div>
                                <div class="col-sm-6">
								<div class="form-group">
                                        <label><strong>Owner Name</strong></label>
                                        <input class="form-control" type="text" required name="ownamne">
                                    </div>
								</div>
								<div class="col-sm-6">
								<div class="form-group">
                                        <label><strong>Owner Email</strong></label>
                                        <input class="form-control" type="text" required name="owemail">
                                    </div>
                                </div>
                                <div class="col-sm-6">
								<div class="form-group">
                                        <label><strong>Owner Contact</strong> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" required name="ownercontact">
                                    </div>
							
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label><strong>Clinic Registration Number</strong></label>
                                        <input class="form-control" type="text" required name="registration">
                                    </div>
                                </div>
                                <!-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input class="form-control" type="password">
                                    </div>
                                </div> -->
								<div class="col-sm-12">
                                    <div class="form-group">
                                        <label><strong>Clinic Established</strong></label>
                                        <div class="">
                                            <input type="date" class="form-control" required name="established">
                                        </div>
                                    </div>
                                </div>
                               
								
								
								<div class="col-sm-12">
									<div class="row">
										
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="form-group">
											<label><strong>Country</strong></label>
											<select  class="countries order-alpha input-style form-control " autocomplete="false" required name="country" id="countryIds">
											<option value="">Select Country</option>
											<?php
											foreach ($fetchCountries as $FC) 
											{
											echo '<option value="'.$FC->country_id.'">'.$FC->name.'</option>';

											}
											?>  
											</select>
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="form-group">
												<label><strong>State/Province </strong>:</label>
												
												<select name="state" class="states order-alpha input-style form-control " autocomplete="false" required id="stateId">
						<option value="0">Select State</option>
					
					</select>
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="form-group">
											
												<label><strong>City </strong>:</label>
												<select name="city" class="cities order-alpha cit input-style form-control " autocomplete="false" required id="cityId">
						<option value="0">Select City</option>
					</select>
											</div>
										</div>
										
										
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="form-group">
												<label><strong>Postal Code</strong></label>
												<input type="text" class="form-control"required name="postcode">
											</div>
										</div>
										<div class="col-sm-6">
								<div class="form-group">
                                        <label><strong>Latitude</strong></label>
                                        <div class="">
                                            <input type="text" class="form-control" required name="latitude">
										</div>
										
                                    </div>
								</div>
								<div class="col-sm-6">
								<div class="form-group">
                                        <label><strong>Longitude</strong></label>
                                        <div class="">
                                            <input type="text" class="form-control" required name="longitude">
										</div>
										
                                    </div>
								</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label><strong>Address</strong></label>
												<textarea class="form-control" rows="3" cols="30" required name="address"></textarea>
											</div>
										</div>
									</div>
								</div>
                                <!-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label><strong>Phone</strong> </label>
                                        <input class="form-control" type="text"  name="phnnumber">
                                    </div>
                                </div> -->
                                <div class="col-sm-6">
									<div class="form-group">
										<label><strong>Image</strong></label>
										<div class="profile-upload">
											<!-- <div class="upload-img">
												<img alt="" src="assets/img/user.jpg">
											</div> -->
											<div class="upload-input">
											<input type="file"  name="files[]"  required multiple>
											</div>
										</div>
									</div>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label><strong>Short Biography</strong></label>
                                <textarea class="form-control" rows="3" cols="30" required name="bio"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="display-block"><strong>Status</strong></label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="doctor_active" value="1" checked>
									<label class="form-check-label" for="doctor_active">
									<strong>Active</strong>
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="doctor_inactive" value="2">
									<label class="form-check-label" for="doctor_inactive">
									<strong>Inactive</strong>
									</label>
								</div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button type="submit" class="btn btn-primary submit-btn" id="abc">Create Clinic</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
			<!-- <div class="notification-box">
                <div class="msg-sidebar notifications msg-noti">
                    <div class="topnav-dropdown-header">
                        <span>Messages</span>
                    </div>
                    <div class="drop-scroll msg-list-scroll" id="msg_list">
                        <ul class="list-box">
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Richard Miles </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item new-message">
                                        <div class="list-left">
                                            <span class="avatar">J</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">John Doe</span>
                                            <span class="message-time">1 Aug</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">T</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Tarah Shropshire </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">M</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Mike Litorus</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">C</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Catherine Manseau </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">D</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Domenic Houston </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">B</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Buster Wigton </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Rolland Webber </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">C</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Claire Mapes </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">M</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Melita Faucher</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">J</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Jeffery Lalor</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">L</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Loren Gatlin</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">T</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Tarah Shropshire</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="chat.html">See all messages</a>
                    </div>
                </div>
            </div> -->
		</div>
		