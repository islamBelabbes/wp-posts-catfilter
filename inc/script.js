const wp_cat_filter = () => {
  addEventListener("DOMContentLoaded", () => {
    const fetchdata = () => {
      jQuery.ajax({
        url: "http://127.0.0.1/port/wp-json/wpcatfilter/v2",
        method: "GET",
        success: function (response) {
          display(response);
          displayfilter(response);
          filter(response);
          document.querySelector(".wp-cat-loading").style.display = "none";
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(errorThrown);
          // handle the error case
        },
      });
    };
    const filter = (filterarr) => {
      const filtertabs = document.querySelectorAll(".tabsfilter");
      filtertabs.forEach((tab) => {
        tab.addEventListener("click", (e) => {
          filtertabs.forEach((tabactive) => {
            tabactive.style.backgroundColor = "#ffffff";
            tabactive.style.color = "#222222";
          });
          tab.style.backgroundColor = "#121212";
          tab.style.color = "#f7f7f7";
          if (tab.dataset.tabs_id === "all") {
            display(filterarr);
            return;
          }
          const filterdata = filterarr.filter((item) => {
            return item.cat_name
              .map((itemmap) => itemmap.toLowerCase())
              .includes(tab.dataset.tabs_id);
          });
          display(filterdata);
        });
      });
    };
    const display = (arr) => {
      const template = document.querySelector("[data-grid-item-templte]");
      const main = document.querySelector(".post_grid");
      main.innerHTML = "";
      arr.forEach((item) => {
        const postcard = template.content.cloneNode(true).children[0];
        postcard.dataset.tabs_id = item.cat_name.join(",");
        postcard.querySelector(
          "#wp-cat-categories"
        ).textContent = `[${item.cat_name.join(",")}]`;
        postcard.querySelector("#title").textContent = item.title;
        postcard.querySelector("#title_des").textContent = item.content;
        postcard.querySelector(".post_img img").src = item.img;
        postcard.querySelector(".readmorebutton").href = item.permalink;
        main.appendChild(postcard);
      });
    };
    const displayfilter = (tabarr) => {
      const tabs = document.querySelector(".filter_tabs");
      let uniq = [];
      tabarr.forEach((currentItem) => {
        uniq.push(currentItem.cat_name);
      });
      const tabshtml = [...new Set(uniq.flat())].map((item) => {
        return `
        <button class="button-23 tabsfilter" data-tabs_id=${item.toLowerCase()}>${item}</button>
        `;
      });
      tabs.innerHTML += tabshtml.join("");
    };
    fetchdata();
  });
};
wp_cat_filter();
