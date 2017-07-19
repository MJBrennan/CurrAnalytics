function ajaxLoader()
{
 $.ajaxSetup({
     headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
     });

$.ajax({
    get:"get",
    url:"prefs",
    success:function(data)
    {
    console.log(data);
    }
    });

}