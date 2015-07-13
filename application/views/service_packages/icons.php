

  <style type="text/css">

#icons_table tr td
{
  padding : 10px 0px;
}

#icons_table tr td a i:hover
{
  color: green !important;
    font-size: 14px;
}

  
  input[name=search_icons]
  {
    width:45%;
    margin-left:34%;
    margin-bottom:5%;
  }
  #icons_table_2
  {
    display: none;
  }

</style>

<script type="text/javascript">
  
  $(document).on('click','#icons_table tr td a',function()
  {
      icon_name = $(this).find('i').attr('class');

      icon_tag = $(this).html();

     icon_html = '<a href="javascript:void()" class="btn btn-success">';
     icon_html+= ''+icon_tag+'</a>';

     $('#icon_show').html(icon_html);
     $('input[name=icon]').val(icon_name);

      $('#icon_modal').modal('hide');    
  });

</script>


<script type="text/javascript">
  $(document).on('keyup','input[name=search_icons]',function()
  {
   
   search_name = $('input[name=search_icons]').val(); 
    
    html = "<tr>";
    i=1;
    $('#icons_table_2 tr td').each(function(){
     str = $(this).find('i').attr('class');
       response = str.search(search_name);
     // alert(str);
     // alert(response);
       // alert(response);
       if(response!="-1")
       {
        if(i%8==0)
        {
          html += '</tr><tr>';
        }
        html += '<td>'+$(this).html()+'</td>';
        // alert(html);
        i++;
       } 
    }); 

       // alert(html)
       if(html!="")
       {
        $('#icons_table').html(html);
       }
 
  });
</script>


<input type='text'  placeholder="Search Icons" class='form-control' name='search_icons' value=''> 

      <table id="icons_table">

        <tr>
          
        <td>
          <a href="javascript:void(0)" style="margin:50px" >
            <i class="fa-icon-instagram"></i>
            </a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-plus"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-euro"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-minus"></i></a>
        </td>
      

        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-cloud"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-envelope"></i></a>
        </td>
      

        
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-pencil"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-glass"></i></a>
        </td>

        </tr>
        <tr>

        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-music"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-search"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-heart"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-star"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-user"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-film"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-th-large"></i></a>
        </td>


      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-th"></i></a>
        </td>


    </tr>
    <tr>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-th-list"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-signal"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-cog"></i></a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-volume-off"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-volume-down"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-volume-up"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-qrcode"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-barcode"></i></a>
        </td>


    </tr>
    <tr>

      
      

        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-inbox"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-play-circle"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-repeat"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-refresh"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-list-alt"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-lock"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-flag"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-headphones"></i></a>
        </td>

        </tr>
        <tr>
          
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-tag"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-tags"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-book"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-bookmark"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-print"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-camera"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-font"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-bold"></i></a>
        </td>

        </tr>
        <tr>
          
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-italic"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-text-height"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-text-width"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-align-left"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-align-center"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-align-right"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-align-justify"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-list"></i></a>
        </td>

        </tr>
        <tr>
          
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-fast-backward"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-backward"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-play"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-pause"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-map-marker"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-adjust"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-tint"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-edit"></i></a>
        </td>

        </tr>
        <tr>
          
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-share"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-check"></i></a>
        </td>
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-step-backward"></i></a>
        </td>
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-stop"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-forward"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-fast-forward"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-step-forward"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-eject"></i></a>
        </td>

        </tr>
        <tr>
          
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-chevron-left"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-chevron-right"></i></a>
        </td>
      

      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-arrow-left"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-arrow-right"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-arrow-up"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-arrow-down"></i></a>
        </td>
      
       
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-gift"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-leaf"></i></a>
        </td>

        </tr>
        <tr>
          
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-fire"></i></a>
        </td>
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-plane"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-calendar"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-random"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-comment"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-magnet"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-chevron-up"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-chevron-down"></i></a>
        </td>

        </tr>
        <tr>
          
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-retweet"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-shopping-cart"></i></a>
        </td>
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-folder-open"></i></a>
        </td>
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-bullhorn"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-bell"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-certificate"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-thumbs-up"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-thumbs-down"></i></a>
        </td>

          
      

    </tr>      
    <tr>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-globe"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-wrench"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-tasks"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-filter"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-briefcase"></i></a>
        </td>
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-dashboard"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-paperclip"></i></a>
        </td>
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-link"></i></a>
        </td>
      
     </tr>
     <tr>
      

        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-phone"></i></a>
        </td>
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-usd"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-gbp"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-sort"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-flash"></i></a>
        </td>
       
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-credit-card"></i></a>
        </td>
     
        
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-cloud-download"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-cloud-upload"></i></a>
        </td>

        </tr>
        <tr>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
            <i class="im-icon-starburst"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
             <i class="im-icon-bars"></i>
          </a>
        </td>
 
        <td>
          <a href="javascript:void(0)" style="margin:50px" >
             <i class="im-icon-bars-3"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
              <i class="im-icon-trophy-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
             <i class="im-icon-basket"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
                <i class="im-icon-bookmark-3"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
              <i class="im-icon-briefcase-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-arrow-up-8"></i>
          </a>
        </td>


</tr>
<tr>
  

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-arrow-up-8"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-bomb"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="fa-icon-tasks"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-ticket"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-temperature"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-accessibility"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-busy-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-king"></i>
          </a>
        </td>

</tr>
<tr>
  

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-king"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-stumbleupon"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-train"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-brightness-medium"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-database"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-dumbbell"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="fa-icon-rupee"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-lamp-4"></i>
          </a>
        </td>

</tr>
<tr>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="fa-icon-money"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-blogger-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-phone"></i>
          </a>
        </td>


        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-warning-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-star-5"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-quill-3"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-stairs-down"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-watch"></i>
          </a>
        </td>

        </tr>

        <tr>
          

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-trophy-star"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-steam-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="fa-icon-align-justify"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-bars-6"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-archive"></i>
          </a>
        </td>


        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-checkmark-circle-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-clock-6"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-airplane"></i>
          </a>
        </td>

</tr>
<tr>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-strikethrough-3"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-snowflake"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-stop-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-vcard"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="fa-icon-puzzle-piece"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-arrow-square"></i>
          </a>
        </td>

        
        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="fa-icon-hdd-o"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-arrow-up-right-7"></i>
          </a>
        </td>

</tr>
<tr>
  
        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-bookmarks"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-brain"></i>
          </a>
        </td>


        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-busy-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-cube"></i>
          </a>
        </td>

  

    </table>  

<table id="icons_table_2">

        <tr>
        	
        <td>
          <a href="javascript:void(0)" style="margin:50px" >
            <i class="fa-icon-instagram"></i>
            </a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-plus"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-euro"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-minus"></i></a>
        </td>
      

        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-cloud"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-envelope"></i></a>
        </td>
      

        
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-pencil"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-glass"></i></a>
        </td>

        </tr>
        <tr>

        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-music"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-search"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-heart"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-star"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-user"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-film"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-th-large"></i></a>
        </td>


      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-th"></i></a>
        </td>


		</tr>
		<tr>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-th-list"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-signal"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-cog"></i></a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-volume-off"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-volume-down"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-volume-up"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-qrcode"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-barcode"></i></a>
        </td>


		</tr>
		<tr>

      
      

        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-inbox"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-play-circle"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-repeat"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-refresh"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-list-alt"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-lock"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-flag"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-headphones"></i></a>
        </td>

        </tr>
        <tr>
        	
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-tag"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-tags"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-book"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-bookmark"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-print"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-camera"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-font"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-bold"></i></a>
        </td>

        </tr>
        <tr>
        	
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-italic"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-text-height"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-text-width"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-align-left"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-align-center"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-align-right"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-align-justify"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-list"></i></a>
        </td>

        </tr>
        <tr>
        	
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-fast-backward"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-backward"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-play"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-pause"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-map-marker"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-adjust"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-tint"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-edit"></i></a>
        </td>

        </tr>
        <tr>
        	
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-share"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-check"></i></a>
        </td>
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-step-backward"></i></a>
        </td>
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-stop"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-forward"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-fast-forward"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-step-forward"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-eject"></i></a>
        </td>

        </tr>
        <tr>
        	
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-chevron-left"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-chevron-right"></i></a>
        </td>
      

      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-arrow-left"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-arrow-right"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-arrow-up"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-arrow-down"></i></a>
        </td>
      
       
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-gift"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-leaf"></i></a>
        </td>

        </tr>
        <tr>
        	
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-fire"></i></a>
        </td>
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-plane"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-calendar"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-random"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-comment"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-magnet"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-chevron-up"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-chevron-down"></i></a>
        </td>

        </tr>
        <tr>
        	
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-retweet"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-shopping-cart"></i></a>
        </td>
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-folder-open"></i></a>
        </td>
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-bullhorn"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-bell"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-certificate"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-thumbs-up"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-thumbs-down"></i></a>
        </td>

        	
      

    </tr>      
    <tr>
    	
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-globe"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-wrench"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-tasks"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-filter"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-briefcase"></i></a>
        </td>
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-dashboard"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-paperclip"></i></a>
        </td>
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-link"></i></a>
        </td>
      
     </tr>
     <tr>
     	

        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-phone"></i></a>
        </td>
      
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-usd"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-gbp"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-sort"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-flash"></i></a>
        </td>
       
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-credit-card"></i></a>
        </td>
     
        
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-cloud-download"></i></a>
        </td>
      
        <td>
          <a href="javascript:void(0)" style="margin:50px" ><i class="fa fa-cloud-upload"></i></a>
        </td>

        </tr>
        <tr>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
            <i class="im-icon-starburst"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
             <i class="im-icon-bars"></i>
          </a>
        </td>
 
        <td>
          <a href="javascript:void(0)" style="margin:50px" >
             <i class="im-icon-bars-3"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
              <i class="im-icon-trophy-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
             <i class="im-icon-basket"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
                <i class="im-icon-bookmark-3"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
              <i class="im-icon-briefcase-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-arrow-up-8"></i>
          </a>
        </td>


</tr>
<tr>
  

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-arrow-up-8"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-bomb"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="fa-icon-tasks"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-ticket"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-temperature"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-accessibility"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-busy-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-king"></i>
          </a>
        </td>

</tr>
<tr>
  

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-king"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-stumbleupon"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-train"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-brightness-medium"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-database"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-dumbbell"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="fa-icon-rupee"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-lamp-4"></i>
          </a>
        </td>

</tr>
<tr>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="fa-icon-money"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-blogger-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-phone"></i>
          </a>
        </td>


        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-warning-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-star-5"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-quill-3"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-stairs-down"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-watch"></i>
          </a>
        </td>

        </tr>

        <tr>
          

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-trophy-star"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-steam-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="fa-icon-align-justify"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-bars-6"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-archive"></i>
          </a>
        </td>


        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-checkmark-circle-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-clock-6"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-airplane"></i>
          </a>
        </td>

</tr>
<tr>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-strikethrough-3"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-snowflake"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-stop-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-vcard"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="fa-icon-puzzle-piece"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-arrow-square"></i>
          </a>
        </td>

        
        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="fa-icon-hdd-o"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-arrow-up-right-7"></i>
          </a>
        </td>

</tr>
<tr>
  
        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-bookmarks"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-brain"></i>
          </a>
        </td>


        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-busy-2"></i>
          </a>
        </td>

        <td>
          <a href="javascript:void(0)" style="margin:50px" >
<i class="im-icon-cube"></i>
          </a>
        </td>

  

    </table>