$(() => {
            
    $('#formReg').submit((e) => {
        e.preventDefault();
        let formData =  $('#formReg').serialize();
        
        $.ajax({
            type: 'POST',
            url: './phpInc/register.php',
            data: formData,
            success: function(result) {
                if (result) {
                    $('.repot').text(result);
                } else { 
                    location.replace('dashboard.php');
                }
            }
        })
    });

    $('#formlogin').submit((e) => {
        e.preventDefault();
        let formData =  $('#formlogin').serialize();
        
        $.ajax({
            type: 'POST',
            url: './phpInc/login.php',
            data: formData,
            success: function(result) {
                if (result) {
                    $('.repot').text(result);
                } else { 
                    location.replace('dashboard.php');
                }
    
            }
        })
    });

    $('#formreset').submit((e) => {
        e.preventDefault();
        let formData =  $('#formreset').serialize();
        
        $.ajax({
            type: 'POST',
            url: './phpInc/passwordreset.php',
            data: formData,
            success: function(result) {
                $('.repot').text(result);
            }
        })
    });

});



//Google Login auth

  var GoogleAuth;
  var SCOPE = 'https://www.googleapis.com/auth/drive.metadata.readonly';
  function handleClientLoad() {
    // Load the API's client and auth2 modules.
    // Call the initClient function after the modules load.
    gapi.load('client:auth2', initClient);
  }

  function initClient() {
    // Retrieve the discovery document for version 3 of Google Drive API.
    // In practice, your app can retrieve one or more discovery documents.
    var discoveryUrl = 'https://www.googleapis.com/discovery/v1/apis/drive/v3/rest';

    // Initialize the gapi.client object, which app uses to make API requests.
    // Get API key and client ID from API Console.
    // 'scope' field specifies space-delimited list of access scopes.
    gapi.client.init({
        'apiKey': 'AIzaSyC0mmcjcDYE_9vaQOHiQa8RZ10ZNkovUc0',
        'discoveryDocs': [discoveryUrl],
        'clientId': '231468933986-hunshlo05rqd8ta512i79me4vdmss6b1.apps.googleusercontent.com',
        'scope': SCOPE
    }).then(function () {
      GoogleAuth = gapi.auth2.getAuthInstance();

      // Listen for sign-in state changes.
      GoogleAuth.isSignedIn.listen(updateSigninStatus);

      // Handle initial sign-in state. (Determine if user is already signed in.)
      var user = GoogleAuth.currentUser.get();
      setSigninStatus();

      // Call handleAuthClick function when user clicks on
      //      "Sign In/Authorize" button.
      $('#sign-in-or-out-button').click(function() {
        handleAuthClick();
      }); 
      $('#revoke-access-button').click(function() {
        revokeAccess();
      }); 
    });
  }

  function handleAuthClick() {
    if (GoogleAuth.isSignedIn.get()) {
      // User is authorized and has clicked 'Sign out' button.
      GoogleAuth.signOut();
    } else {
      // User is not signed in. Start Google auth flow.
      GoogleAuth.signIn();
    }
  }

  function revokeAccess() {
    GoogleAuth.disconnect();
  }

  function setSigninStatus(isSignedIn) {
    var user = GoogleAuth.currentUser.get();
    var isAuthorized = user.hasGrantedScopes(SCOPE);
    if (isAuthorized) {
      $('#sign-in-or-out-button').html('Sign out');
      $('#revoke-access-button').css('display', 'inline-block');
      $('#auth-status').html('You are currently signed in and have granted ' +
          'access to this app.');
    } else {
      $('#sign-in-or-out-button').html('Sign In/Authorize');
      $('#revoke-access-button').css('display', 'none');
      $('#auth-status').html('You have not authorized this app or you are ' +
          'signed out.');
    }
  }

  function updateSigninStatus(isSignedIn) {
    setSigninStatus();
  }
