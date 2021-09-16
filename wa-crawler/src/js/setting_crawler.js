jQuery(document).ready(function () {
  var submitConfig = document.getElementById("submitConfig");
  submitConfig.addEventListener("click", function () {
    var linkCrawl = document.getElementById("inpLink").value;
    fetch(
      `${apiObject.rootapiurl}wa-option/v1/save-link-crawler?_wpnonce=${apiObject.nonce}`,
      {
        method: "POST",
        mode: "cors",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify({
          slug: linkCrawl,
          wp_rest: apiObject.nonce,
        }),
      }
    )
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
      });
  });
});
