console.log(`ookk`);



  let dianLubis = <?php echo json_encode($cobaD) ?>;
  console.log(dianLubis);



// AM Contribution by Contract
var xValues = ["Dian Lubis", "Dian Octavia","Meita"];
  var yValues = [10, 2, 3];
  var barColors = [
    "#4285f4",
    "#ea4335",
    "#fbbc04",
    // "#34a853",
    // "#ff6d01",
    // "#46bdc6",
  ];

  new Chart("myChart", {
    type: "pie",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      title: {
        display: true,
        text: "World Wide Wine Production 2018"
      }
    }
  });


  let namaAm =  [ "Dian Lubis", "Dian Octavia", "Meita,"];

  var xValues = namaAm;
var yValues = [10, 20, 22];
var barColors = [
  "#4285f4",
  "#ea4335",
  "#fbbc04",
];

new Chart("myChart2", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "World Wide Wine Production 2018"
    }
  }
});