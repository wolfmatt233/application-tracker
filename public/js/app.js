let sortList = document.querySelector("#sortList");
let searchForm = document.querySelector("#searchForm");
let filterList = document.querySelector("#filterList");

sortList.onchange = (e) => {
  searchForm.submit();
};

filterList.onchange = (e) => {
  searchForm.submit();
};