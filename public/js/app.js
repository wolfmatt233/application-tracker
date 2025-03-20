let curPage = document.URL.split(`${window.location.origin}/`)[1].split("?")[0];
console.log(curPage);

const listForm = () => {
  let sortList = document.querySelector("#sortList");
  let searchForm = document.querySelector("#searchForm");
  let filterBox = document.querySelector("#filterBox");

  sortList.onchange = (e) => {
    searchForm.submit();
  };

  filterBox.onclick = (e) => {
    let classList = e.currentTarget.classList;

    if (classList.contains("filter-opened")) {
      classList.add("filter-closed");
      classList.remove("filter-opened");
    } else {
      classList.add("filter-opened");
      classList.remove("filter-closed");
    }
  };
};

switch (curPage) {
  case "applications":
    listForm();
    break;
  default:
    break;
}
