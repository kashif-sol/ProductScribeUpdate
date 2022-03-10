<?php $__env->startSection('content'); ?>
<section role="main" class="content-body content-body-modern">

<!-- start: page -->
<input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">

<!-- Dashboard start -->
<div class="row">
	<div class="col-lg-12 col-xl-12 pb-2 pb-lg-0 mb-4 mb-lg-0 shadow p-3 mb-5 bg-white rounded">
		<div class="card card-modern">
			<div class="card-body py-4">
				<div class="row align-items-center">
					<div class="col-6 col-md-4">
						<div class="row" style="align-items: center;">
							<div class="col-sm-6">
								<i class="fa-solid fa-coins icon icon-inline icon-xl rounded-circle text-color-light" style="background-color: #191C21; float: right;"></i>
							</div>
							<div class="col-sm-6">
								<h3 class="text-4-1 my-0" style="float: left;">Remaining Credits</h3>
								<strong class="text-6 text-color-dark" style="float: left;"><?php echo e($remaining_credits); ?></strong>
							</div>
						</div>
					</div>
					<div class="col-6 col-md-4 border border-top-0 border-end-0 border-bottom-0 border-color-light-grey py-3">
						<h3 class="text-4-1 text-color-success line-height-2 my-0"><i class="fa-solid fa-clock"></i> Last Use</h3>
						<span><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($credit_updated_at->updated_at))->diffForHumans()?></span>
					</div>
					<div class="col-6 col-md-4 border border-top-0 border-end-0 border-bottom-0 border-color-light-grey py-3">
						<h3 class="text-4-1 text-color-success line-height-2 my-0"><i class="fa-solid fa-box-open"></i> Want to change package ?</h3>
						<a href="<?php echo e(route('plans')); ?>" class="btn btn-default" style="background-color: #191C21; border: none; color: white; margin-top: 10px;">Click here <i class="fa-solid fa-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Dashboard end -->

	<div class="row">
		<div class="col">

			<div class="card card-modern card-modern-table-over-header shadow p-3 mb-5 bg-white rounded">
				<div class="card-header">
					<h2 class="card-title">Products</h2>
				</div>
				<div class="card-body">
				<div id="message" class="alert alert-info alert-dismissible fade show" role="alert" style="display: none;">
				<label id="message_label"></label>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>
				</div>
				<div class="modal" id="modalBootstrap" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header" style="padding-bottom: 0px;">
								<p id="model_product_title" style="font-size: 16px; font-weight: 700; margin-top: 5px;"></p>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body" style="padding: 0px; height:360px; overflow-y: scroll; overflow-x: hidden">
							<div class="card-body"  style="padding: 0px;">
								<div id="loadingCard" class="card-body" data-loading-overlay data-loading-overlay-options='{ "startShowing": false, "css": { "backgroundColor": "#ffff" } }' style="min-height: 150px;">
									<form class="form-horizontal form-bordered">
										<input type="text" name="productId" id="productId" hidden>
										<div id="newRow"></div>
										<div id="resultRow"></div>
									</form>
								</div>
							</div>
							</div>
							<div class="modal-footer" style="display: block;">
								<div class="row">
									<div class="col-sm-3">
										<button id="addRow" type="button" class="btn btn-default" style="float: left; border-radius: 100%;"><i class="fa-solid fa-plus"></i></button>
										<label style="float: left; padding: 6px;" id="addRowLabel" >Fields</label>
									</div>
									<div class="col-sm-9">
									<button id="cancelProductSubmission" type="button" class="btn btn-default" data-bs-dismiss="modal" style="margin: 5px; float: right;"><i class="fa fa-close"></i> Close</button>
										<button id="submitProduct" type="button" class="btn btn-default" style="margin: 5px; float: right; background-color: #191C21; border: none; color: white;"><i class="fas fa-search"></i> Search</button>
										<button id="publishProduct" type="button" class="btn btn-default" style="margin: 5px; float: right; background-color: #191C21; border: none; color: white;">Publish Product</button>
										<button id="goBack" type="button" class="btn btn-default" style="margin: 5px; float: right; background-color: #191C21; border: none; color: white;">Back</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<table class="table table-striped">
				<thead>
					<tr>
					<th scope="col">Title</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<?php if(isset($product['images'][0])): ?>
                            <td width="60px"><img src="<?php echo e($product['images'][0]['src']); ?>" height="60px" width="60px" alt="description of myimage" style="border-radius: 4px;"></td>
                            <?php else: ?>
                            <td><img src="<?php echo e(asset('Images/NoImage.png')); ?>" height="60px" width="60px" alt="description of myimage"></td>
                            <?php endif; ?>
							<td>
								<div class="row">
									<strong><?php echo e($product['title']); ?></strong>
								</div>
								<div class="row">
									<label style="color: #6F6F91;"><?php echo substr(strip_tags($product['body_html']),0,40); ?> . . .</label>
								</div>
								<div class="row">
									<label style="color: #6F6F91;">Price: <?php echo e($product['variants']['0']['price']); ?></label> 
								</div>
								
							</td>
							<td class="editButton" style="vertical-align: middle;">
								<button data-id="<?php echo e($product['id']); ?>" data-title="<?php echo e($product['title']); ?>" class="mb-1 mt-1 me-1 btn btn-default" data-bs-toggle="modal" data-bs-target="#modalBootstrap" style="border-radius: 5%; background-color: #191C21; color: white; border-radius: 3px;">Title</button>
							</td>
							<td class="descriptionButton" style="vertical-align: middle;">
								<button data-id="<?php echo e($product['id']); ?>" data-title="<?php echo e($product['title']); ?>" class="mb-1 mt-1 me-1 btn btn-default" data-bs-toggle="modal" data-bs-target="#modalBootstrap" style="border-radius: 5%; background-color: #191C21; color: white; border-radius: 3px;">Description</button>
							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
				</table>
				<div class="row">
					<?php if(isset($link["previous"]) && isset($link["next"])): ?>
						<div class="col-sm-2">
							<a href="<?php echo e(url('/view-products?pageInfo='.$link["previous"])); ?>" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Previous</a>
						</div>
						<div class="col-sm-2">
							<a href="<?php echo e(url('/view-products?pageInfo='.$link["next"])); ?>" class="btn btn-primary">Next  <i class="fa-solid fa-arrow-right"></i></a>
						</div>
					<?php else: ?>
						<?php if(isset($link["next"])): ?>
							<div class="col-sm-2">
								<button class="btn btn-primary" disabled><i class="fa-solid fa-arrow-left"></i> Previous</button>
							</div>	
							<div class="col-sm-2">
								<a href="<?php echo e(url('/view-products?pageInfo='.$link["next"])); ?>" class="btn btn-primary">Next <i class="fa-solid fa-arrow-right"></i></a>
							</div>
						<?php endif; ?>

						<?php if(isset($link["previous"])): ?>
							<div class="col-sm-2">
								<a href="<?php echo e(url('/view-products?pageInfo='.$link["previous"])); ?>" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Previous</a>
							</div>
							<div class="col-sm-2">
								<button class="btn btn-primary" disabled>Next <i class="fa-solid fa-arrow-right"></i></a>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<!-- end: page -->
</section>
<script src="<?php echo e(asset('ThemeData/vendor/jquery/jquery.js')); ?>"></script>

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<script>

	$(document).ready(function(){

		$('#publishProduct').hide();
		$('#goBack').hide();
		$('#submitProduct').show();
		var formSwitchType = '';
		var $el = $('#loadingCard');
		var user_id ='<?php echo $user_id; ?>';
		var productIds = [];
		var globalResponseArray = [];
		if(localStorage.getItem("message") == 1){
			$("#message_label").text(localStorage.getItem('messageText'));
			$("#message").show();
			localStorage.setItem("message", "0");
		}
		else{
			$("#message").hide();
		}

		$("#selectAllProducts").on("change", function(){
			$('.allChecks input:checkbox').each(function() {
				if($("#selectAllProducts").is(':checked')){
					$(this).prop('checked', true)
				}
				else{
					$(this).prop('checked', false)
				}
			});
		});

		$('.editButton button').on("click", function() {
		   $el.trigger('loading-overlay:hide');
		   	$('#newRow').empty();
			$('#newRow').show();
			$('#resultRow').empty();
			$('#resultRow').hide();
			$('#newRow').append(formFieldTemplete('title',0));
			$('#addRow').show();
			$('#addRowLabel').show();
			$('#publishProduct').hide();
			$('#goBack').hide();
			$('#submitProduct').show();
			$('#productId').val($(this).attr("data-id"));
		   	$('#submitProduct').html('<i class="fa-solid fa-spinner"></i> Generate Title');
		   	$('#model_product_title').html($(this).attr("data-title"));
		});

		$('.descriptionButton button').on("click", function() {
		   $el.trigger('loading-overlay:hide');
		   	$('#newRow').empty();
			$('#newRow').show();
		   	$('#resultRow').empty();
			$('#resultRow').hide();
			$('#newRow').append(formFieldTemplete('description',0));
			$('#addRow').show();
			$('#addRowLabel').show();
			$('#publishProduct').hide();
			$('#goBack').hide();
			$('#submitProduct').show();
			$('#productId').val($(this).attr("data-id"));
		   	$('#submitProduct').html('<i class="fa-solid fa-spinner"></i> Generate Description');
		   	$('#model_product_title').html($(this).attr("data-title"));
		});

		$('#publishProduct').on("click", function() {
			$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			},
			type: "POST",
			url: '/publish-product',
			data: {user_id : globalResponseArray[globalResponseArray.length-1], productId : globalResponseArray[globalResponseArray.length-2] , formTitle: globalResponseArray[globalResponseArray.length-3], data : globalResponseArray[$("input[name='optionsRadio']:checked").val()]},
			success: function(message){
				localStorage.setItem("message", "1");
				localStorage.setItem("messageText", message);
				location.reload(true);
			}
			})
		});

		$('#goBack').on("click", function() {
			$('#chooseScreenHeading').remove();
			$('#generatedTexts').remove();
			$('#resultRow').empty();
			$('#resultRow').hide();
			$('#goBack').hide();
			$('#publishProduct').hide();
			$('#newRow').show();
			$('#addRow').show();
			$('#addRowLabel').show();
			$('#submitProduct').show();
		});

		$("#submitProduct").on("click", function(){

			$el.trigger('loading-overlay:show');

			$('#loadingCard').attr('data-loading-overlay-options','{ "startShowing": true, "css": { "backgroundColor": "#ffff" } }'); 
			
			productIds = [];
			var keywords = [];
			var examples = [];
			var exampleTitles = [];
			var formTitle = $('#formTitle').val();
			var title = $('#title').val();
			var outputLanguage = $('#languageTo').val();
			var inputLanguage = $('#languageFrom').val();
			var completion = $('#completion').val();
			productIds.push($('#productId').val());
			
			$('input[name^="keywords"]').each(function() {
				if(this.value != "" )
					keywords.push(this.value);
			});

			$('input[name^="examples"]').each(function() {
				if(this.value != "" )
					examples.push(this.value);
			});

			$('input[name^="exampleTitles"]').each(function() {
				if(this.value != "" )
				exampleTitles.push(this.value);
			});
		
			$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			},
			type: "POST",
			url: '/submit-product',
			data: {formTitle: formTitle, outputLanguage: outputLanguage, inputLanguage: inputLanguage, completion: completion, title: title, productIds: productIds, keywords: keywords, examples : examples, exampleTitles : exampleTitles, user_id: user_id},
			success: function(responseArray){
				if(responseArray[0] == 'title'){
					$el.trigger('loading-overlay:hide');
					if(responseArray[2] == 200){
						$('#newRow').empty();
						$('#newRow').append(formFieldTemplete('title',0));
						$('#addRow').show();
						$('#addRowLabel').show();
						$('#publishProduct').hide();
						$('#goBack').hide();
						$('#submitProduct').show();
						$('#productId').val($(this).attr("data-id"));
						var error = '';
						error += '<label style="color:#C00000;">'+responseArray[1]+'</label>';
						$('.keywordClass').append(error);
					}
					else if(responseArray[2] == 400){
						$('#newRow').empty();
						$('#newRow').append(formFieldTemplete('title',0));
						$('#addRow').show();
						$('#addRowLabel').show();
						$('#publishProduct').hide();
						$('#goBack').hide();
						$('#submitProduct').show();
						$('#productId').val($(this).attr("data-id"));
						showMonoErrorAlert(responseArray[1]);
					}
					else if(responseArray[2] == 402){
						$('#newRow').empty();
						$('#newRow').append(formFieldTemplete('title',0));
						$('#addRow').show();
						$('#addRowLabel').show();
						$('#publishProduct').hide();
						$('#goBack').hide();
						$('#submitProduct').show();
						$('#productId').val($(this).attr("data-id"));
						showMonoErrorAlert(responseArray[1]);
					}
				}
				else if(responseArray[0] == 'description') {
					if(responseArray[2] == 200){
						$el.trigger('loading-overlay:hide');
						$('#newRow').empty();
						$('#newRow').append(formFieldTemplete('description',0));
						$('#addRow').show();
						$('#addRowLabel').show();
						$('#publishProduct').hide();
						$('#goBack').hide();
						$('#submitProduct').show();
						$('#productId').val($(this).attr("data-id"));
						var error = '';
							error += '<label style="color:#C00000;">'+responseArray[1]+'</label>';
							$('.titleClass').append(error);
					}
					else if(responseArray[2] == 400){
						$el.trigger('loading-overlay:hide');
						$('#newRow').empty();
						$('#newRow').append(formFieldTemplete('title',0));
						$('#addRow').show();
						$('#addRowLabel').show();
						$('#publishProduct').hide();
						$('#goBack').hide();
						$('#submitProduct').show();
						$('#productId').val($(this).attr("data-id"));
						showMonoErrorAlert(responseArray[1]);
					}
					else if(responseArray[2] == 402){
						$el.trigger('loading-overlay:hide');
						$('#newRow').empty();
						$('#newRow').append(formFieldTemplete('title',0));
						$('#addRow').show();
						$('#addRowLabel').show();
						$('#publishProduct').hide();
						$('#goBack').hide();
						$('#submitProduct').show();
						$('#productId').val($(this).attr("data-id"));
						showMonoErrorAlert(responseArray[1]);
					}
				}
				else{
					globalResponseArray = responseArray;
					$el.trigger('loading-overlay:hide');
					$('#newRow').hide(); // show
					$('#addRow').hide();
					$('#addRowLabel').hide();
					$('#submitProduct').hide();
					$('#publishProduct').show();
					$('#goBack').show();
					var html = '';
					// hide
					html += '<h3 id="chooseScreenHeading">Select your desired product '+globalResponseArray[responseArray.length-3]+'</h3>';
					for (let i = 0; i < responseArray.length-3; i++) {
						//hide
						html += '<div id="generatedTexts" style="padding:10px">';
						html += '<div class="radio">';
						html += '<label>';
						if(i==0){
							html += '<input type="radio" name="optionsRadio" id="optionsRadio" value='+i+' checked>';
						}
						else{
							html += '<input type="radio" name="optionsRadio" id="optionsRadio" value='+i+'>';
						}
						html += " ";
						html += responseArray[i];
						html += '</label>';
						html += '</div>';
						html += '</div>';
					}
						$('#resultRow').empty();
						$('#resultRow').append(html);
						$('#resultRow').show();
				}
			}
			})
		});
	});

	function showMonoErrorAlert(message){
		var html = '';
		html += '<div id="modelMessage" class="alert alert-danger alert-dismissible fade show" role="alert">';
		html +=  message;
		html += '<label id="modelMessageLabel"></label>';
		html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>';
		html += '</div>';
		$("#newRow").prepend(html);
	}

	$("#addRow").click(function () {
		$('#newRow').append(formFieldTemplete($('#formTitle').val(),1));
	});

    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputTitleFormRow').remove();
	});

	function formFieldTemplete(form, removeButton){

		var languagesJSON ='<?php echo json_encode($languages); ?>';
		const languages = JSON.parse(languagesJSON);

		console.log(languages[0]);
		if(form == 'title'){
			var html = '';
			if(removeButton == 0){
				// Language From:
				html += '<div class="row pb-1">';
				html += '<label class="col-lg-3 control-label text-lg-end pt-1" for="textareaDefault">Input Language </label>';
				html += '<div class="col-lg-8">';
				html += '<select id="languageFrom" name="languageFrom" class="form-control mb-3">';
				html += '<option value='+languages[0].split('-').pop()+'>'+languages[0]+'</option>';
				for (let i = 1; i < languages.length; i++) {
					html += '<option value='+""+languages[i].split('-').pop()+'>'+languages[i]+'</option>';
				}
				html += '</select>';
				html += '</div>';
				html += '</div>';

				// Language To:
				html += '<div class="row pb-1">';
				html += '<label class="col-lg-3 control-label text-lg-end pt-1" for="textareaDefault">Output Language </label>';
				html += '<div class="col-lg-8">';
				html += '<select id="languageTo" name="languageTo" class="form-control mb-3">';
				html += '<option value='+languages[0].split('-').pop()+'>'+languages[0]+'</option>';
				for (let i = 1; i < languages.length; i++) {
					html += '<option value='+""+languages[i].split('-').pop()+'>'+languages[i]+'</option>';
				}
				html += '</select>';
				html += '</div>';
				html += '</div>';

				html += '<div class="row pb-1">';
				html += '<label class="col-lg-3 control-label text-lg-end pt-1" for="textareaDefault"># of Completions </label>';
				html += '<div class="col-lg-8">';
				html += '<input type="number" class="form-control" id="completion" name="completion" min="1" value="1">';
				html += '</div>';
				html += '</div>';
			}

			html += '<div id="inputTitleFormRow">';
			html += '<input type="text" class="form-control" value="title" name="formTitle" id="formTitle" hidden>';
			html += '<div id="inputTitleFormRow" class="row pb-1">';
			if(removeButton == 0){
			html += '<label class="col-lg-3 control-label text-lg-end pt-1" for="inputDefault">Keyword </label>';
			}
			html += '<div class="col-lg-8 keywordClass">';
			if(removeButton == 0){
				html += '<input type="text" placeholder="Type keywords here" class="form-control" name="keywords[]">';
			}
			html += '</div>';
			html += '</div>';
			html += '<div class="row pb-1">';
			html += '<label class="col-lg-3 control-label text-lg-end pt-1" for="textareaDefault">Example Keyword</label>';
			html += '<div class="col-lg-8">';
			html += '<input type="text" placeholder="Type example keyword here" class="form-control" name="examples[]">';
			html += '</div>';
			html += '<label class="col-lg-3 control-label text-lg-end pt-1" for="textareaDefault">Example Title</label>';
			html += '<div class="col-lg-8">';
			html += '<input type="text" placeholder="Type example title here" class="form-control" name="exampleTitles[]">';
			if(removeButton == 1){
				html += '<div class="input-group-append">';
				html += '<button id="removeRow" type="button" class="btn btn-danger" style="float:right; margin-top:5px">Delete <i class="fa-solid fa-arrow-up"></i></button>';
				html += '</div>';
			}
			html += '</div>';
			html += '</div>';
			html += '</div>';
		}

		if(form == 'description'){
			var html = '';

			if(removeButton == 0){
				// Language From:
				html += '<div class="row pb-1">';
				html += '<label class="col-lg-3 control-label text-lg-end pt-1" for="textareaDefault">Language From </label>';
				html += '<div class="col-lg-8">';
				html += '<select id="languageFrom" name="languageFrom" class="form-control mb-3">';
				html += '<option value='+languages[0].split('-').pop()+'>'+languages[0]+'</option>';
				for (let i = 1; i < languages.length; i++) {
					html += '<option value='+languages[i].split('-').pop()+'>'+languages[i]+'</option>';
				}
				html += '</select>';
				html += '</div>';
				html += '</div>';

				// Language To:
				html += '<div class="row pb-1">';
				html += '<label class="col-lg-3 control-label text-lg-end pt-1" for="textareaDefault">Language To </label>';
				html += '<div class="col-lg-8">';
				html += '<select id="languageTo" name="languageTo" class="form-control mb-3">';
				html += '<option value='+languages[0].split('-').pop()+'>'+languages[0]+'</option>';
				for (let i = 1; i < languages.length; i++) {
					html += '<option value='+languages[i].split('-').pop()+'>'+languages[i]+'</option>';
				}
				html += '</select>';
				html += '</div>';
				html += '</div>';

				html += '<div class="row pb-1">';
				html += '<label class="col-lg-3 control-label text-lg-end pt-1" for="textareaDefault"># of Completions </label>';
				html += '<div class="col-lg-8">';
				html += '<input type="number" class="form-control" id="completion" name="completion" min="1" value="1">';
				html += '</div>';
				html += '</div>';
				html += '<div id="inputTitleFormRow" class="row pb-1">';
				html += '<label class="col-lg-3 control-label text-lg-end pt-1" for="inputDefault">Title </label>';
				html += '<div class="col-lg-8 titleClass">';
				html += '<input type="text" class="form-control" placeholder="Enter title here" id="title" name="title">';
				html += '</div>';
				html += '</div>';
			}
			html += '<div id="inputTitleFormRow">';
			html += '<input type="text" class="form-control" value="description" name="formTitle" id="formTitle" hidden>';
			html += '<div class="row pb-1">';
			html += '<label class="col-lg-3 control-label text-lg-end pt-1" for="textareaDefault">Example Keyword</label>';
			html += '<div class="col-lg-8">';
			html += '<input type="text" placeholder="Type example keyword here" class="form-control" name="examples[]">';
			html += '</div>';
			html += '<label class="col-lg-3 control-label text-lg-end pt-1" for="textareaDefault">Example Title</label>';
			html += '<div class="col-lg-8">';
			html += '<input type="text" placeholder="Type example title here" class="form-control" name="exampleTitles[]">';
			if(removeButton == 1){
				html += '<div class="input-group-append">';
				html += '<button id="removeRow" type="button" class="btn btn-danger" style="float:right; margin-top:5px">Delete <i class="fa-solid fa-arrow-up"></i></button>';
				html += '</div>';
			}
			html += '</div>';
			html += '</div>';
			html += '</div>';	
		}

		return html;
	}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('website', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/734012.cloudwaysapps.com/nkxjeaexpk/public_html/resources/views/Content/products.blade.php ENDPATH**/ ?>