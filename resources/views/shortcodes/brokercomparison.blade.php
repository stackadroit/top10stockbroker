<div class="selectbrockerdiv">  
    <div class="broker-title">
        <h4>Compare Stock Brokers</h4>
    </div>
    <div class="selectbrkerdata">
        <select id="broker1" class="compatess1" name="broker1" style="border-color: rgb(204, 204, 204);">
            <option value="00">Select Broker 1</option>     
            @foreach($ubroker1 as $ub)
                 <option value="{{ str_replace(' ','-',$ub) }}">{{ ucwords($ub) }}</option>
             @endforeach       
         </select>
    </div>
    <div class="selectbrkerdata">
        <select class="compatess2" id="broker2"  name="broker2" style="border-color: rgb(204, 204, 204);">
        	<option value="00">Select Broker 2</option>
        	@foreach($ubroker2 as $ub)
                 <option value="{{ str_replace(' ','-',$ub) }}">{{ ucwords($ub) }}</option>
             @endforeach 
        </select>
    </div>
    <div class="resultcom">
        <button class="comlink">Compare</button>
    </div>
</div>
<script>
jQuery(document).ready(function($) {
    var ajaxurl = "";
         $('#broker1').change(function(event) {
            var Broker = $(this).val();
            $("#broker2 option").removeAttr('disabled');
            $("#broker2 option[value='"+ Broker +"']").attr('disabled','disabled');
            var strBroker1 = $( "#broker1 option:selected" ).val();
            console.log(strBroker1);
        });

        $('#broker2').change(function(event) {
            var Broker = $(this).val();
            $("#broker1 option").removeAttr('disabled');
            $("#broker1 option[value='"+ Broker +"']").attr('disabled','disabled');
            var strBroker2 = $( "#broker2 option:selected" ).val();
            console.log(strBroker2);
        });
        
       $('.comlink').click(function(event){
       
        var strBroker1 = $( "#broker1 option:selected" ).val();
        var strBroker2 = $( "#broker2 option:selected" ).val();
         if((strBroker1 == '00') || (strBroker2 == '00')){
             event.preventDefault();
         }
        $('.selectbrockerdiv').append('<h5 id="loading-image" style="display:none; text-align:center; text-transform:uppercase;">Loading Data..Wait</h5>');
        if((strBroker1 != '00') && (strBroker2 != '00')){
            
            var url1 =  strBroker1+'-vs-'+strBroker2;
            var url2 =  strBroker2+'-vs-'+strBroker1;
            
           var page_paths = [url1,url2];
            jQuery.ajax({
                type:"POST",
                url: ajaxurl,
                data : {
                    'action': 'get_url',
                    'page_paths': page_paths,
                    'security': ''
                },
                 beforeSend: function() {
                    $("#loading-image").show();
                },
                success:function(data){
                    console.log(data)
                  if(data == ''){
                   alert('No comparision Found')  ; 
                  }
                  else{
                      $("#loading-image").hide();
                      var url = data;
                      window.location.href = url;
                  }
                },
                error: function(errorThrown){
                      console.log(errorThrown);
                }
                
            });
          
        }
       
    });
});

</script>