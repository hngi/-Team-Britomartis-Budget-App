
      function openForm() {
        document.getElementById("feedbackPopup").style.display="block";
      }
      
      function closeForm() {
        document.getElementById("feedbackPopup").style.display= "none";
      }
      
      window.onclick = function(event) {
        var modal = document.getElementById('feedbackPopup');
        if (event.target == modal) {
          closeForm();
        }
      }