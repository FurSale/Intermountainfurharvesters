document.addEventListener('DOMContentLoaded', function() {
var elems = document.querySelectorAll('.modal');
var instances = M.Modal.init(elems);
});
document.addEventListener('DOMContentLoaded', function() {
var elems = document.querySelectorAll('.sidenav');
var instances = M.Sidenav.init(elems);
});
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.fab');
  var instances = M.FloatingActionButton.init(elems, {
    direction: 'left'
  });
});
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems);
  });
  document.addEventListener('DOMContentLoaded', function() {
var elems = document.querySelectorAll('.tooltipped');
var instances = M.Tooltip.init(elems);
});
document.addEventListener('DOMContentLoaded', function() {
var elems = document.querySelectorAll('select');
var instances = M.FormSelect.init(elems);
});
