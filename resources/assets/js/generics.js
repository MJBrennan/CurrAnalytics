function ajaxLoader(type,url)
{
 $.ajaxSetup({
     headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
     });

$.ajax({
    get:type,
    url:url,
    success:function(data)
    {
    alert("Working");
    }
    });

}