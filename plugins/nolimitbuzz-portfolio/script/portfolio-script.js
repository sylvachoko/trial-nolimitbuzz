document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll(".portfolio-tab");
  const items = document.querySelectorAll(".portfolio-item");

  tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      // Remove 'active' class from all tabs
      tabs.forEach((t) => t.classList.remove("active"));
      tab.classList.add("active");

      const category = tab.getAttribute("data-category");

      // Show/hide portfolio items based on the selected category
      items.forEach((item) => {
        if (
          category === "all" ||
          item.getAttribute("data-categories").includes(category)
        ) {
          item.style.display = "block";
        } else {
          item.style.display = "none";
        }
      });
    });
  });
});
