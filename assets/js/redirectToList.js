import $ from 'jquery';

function redirectToList(data) {
  var notif = '<div class="notification success">' + data.text + '<br>Redirection vers la liste des rapports dans 3 secondes. </div>';
  $('.notifications').append($(notif));
  setTimeout(function() {
        window.location.href = window.location.protocol + "//" + window.location.host + "/list_submissions"
      },
      3000);
}

export default redirectToList;