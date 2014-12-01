<script>
$(function(){
   gapi.client.load('oauth2', 'v2', function() {
                gapi.client.oauth2.userinfo.get().execute(function(resp){ 
   gapi.auth.signOut(); 
   });
   });
});
</script>