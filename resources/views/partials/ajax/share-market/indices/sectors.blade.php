<div class="section-companylist mb-5">
	<div class="inner-wrap">
		<div class="section-head">
			<h2 class="">{{$section_title}}</h2>
            <p>{{$section_content}}</p>
		</div>
		<form action="" method="post">
			<div class="row mb-4">
			   <div class="col-md-2 col-sm-3">
					<select name="stock_order" id="stock_order" class="">
						<option value="">All</option>
						<option value="G" <?php echo (@$stock_order =='G')?'selected="selected"':''; ?>>Gainers</option>
						<option value="L" <?php echo (@$stock_order =='L')?'selected="selected"':''; ?>>Losers</option>
					</select>
			   </div>
			</div>
		</form>
		<div id="indices-sector-g-l">
		</div>
	    
</div>
 