function loadProducts() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      window.location="index.php?rows=" + this.responseText;
    }
  };
  xhr.open("GET", "get_request.php", true);
  xhr.send();
}

var loadMoreBtn = document.getElementById('loadMore');
loadMoreBtn.addEventListener('click', loadProducts, true);

window.scrollTo(0,document.body.scrollHeight);