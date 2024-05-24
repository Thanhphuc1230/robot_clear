var TableProductListAll=document.getElementById("table-product-list-all");function getChartColorsArray(e){if(null!==document.getElementById(e)){e=document.getElementById(e).getAttribute("data-colors");if(e)return(e=JSON.parse(e)).map(function(e){var t=e.replace(" ","");return-1===t.indexOf(",")?getComputedStyle(document.documentElement).getPropertyValue(t)||t:2==(e=e.split(",")).length?"rgba("+getComputedStyle(document.documentElement).getPropertyValue(e[0])+","+e[1]+")":t})}}TableProductListAll&&new gridjs.Grid({columns:[{name:"#",width:"40px",sort:{enabled:!1},data:function(e){return gridjs.html('<div class="form-check checkbox-product-list">\t\t\t\t\t<input class="form-check-input" type="checkbox" value="'+e.id+'" id="checkbox-'+e.id+'">\t\t\t\t\t<label class="form-check-label" for="checkbox-'+e.id+'"></label>\t\t\t\t  </div>')}},{name:"Product",width:"360px",formatter:function(e){return gridjs.html('<div class="d-flex align-items-center"><div class="flex-shrink-0 me-3"><div class="avatar-sm bg-light rounded p-1"><img src="assets/images/products/'+e[0]+'" alt="" class="img-fluid d-block"></div></div><div class="flex-grow-1"><h5 class="fs-14 mb-1"><a href="apps-ecommerce-product-details.html" class="text-body">'+e[1]+'</a></h5><p class="text-muted mb-0">Category : <span class="fw-medium">'+e[2]+"</span></p></div></div>")}},{name:"Stock",width:"94px"},{name:"Price",width:"101px"},{name:"Orders",width:"84px"},{name:"Rating",width:"105px",formatter:function(e){return gridjs.html('<span class="badge bg-light text-body fs-12 fw-medium"><i class="mdi mdi-star text-warning me-1"></i>'+e+"</span></td>")}},{name:"Published",width:"220px",formatter:function(e){return gridjs.html(e[0]+'<small class="text-muted ms-1">'+e[1]+"</small>")}},{name:"Action",width:"80px",sort:{enabled:!1},formatter:function(e){return gridjs.html('<div class="dropdown"><button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></button><ul class="dropdown-menu dropdown-menu-end"><li><a class="dropdown-item" href="apps-ecommerce-product-details.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li><li><a class="dropdown-item" href="apps-ecommerce-add-product.html"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li><li class="dropdown-divider"></li><li><a class="dropdown-item" href="#!"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li></ul></div>')}}],className:{th:"text-muted"},pagination:{limit:10},sort:!0,data:[[["img-1.png","Half Sleeve Round Neck T-Shirts","Clothes"],"12","$ 115.00","48","4.2",["12 Oct, 2021","10:05 AM"]],[["img-2.png","Urban Ladder Pashe Chair","Furniture"],"06","$ 160.00","30","4.3",["06 Jan, 2021","01:31 PM"]],[["img-3.png","350 ml Glass Grocery Container","Kitchen Storage & Containers"],"10","$ 25.00","48","4.5",["26 Mar, 2021","11:40 AM"]],[["img-4.png","Fabric Dual Tone Living Room Chair","Furniture"],"15","$ 140.00","40","4.2",["19 Apr, 2021","02:51 PM"]],[["img-5.png","Crux Motorsports Helmet","Bike Accessories"],"08","$ 135.00","55","4.4",["30 Mar, 2021","09:42 AM"]],[["img-6.png","Half Sleeve T-Shirts (Blue)","Clothes"],"15","$ 125.00","48","4.2",["12 Oct, 2021","04:55 PM"]],[["img-7.png","Noise Evolve Smartwatch","Watches"],"12","$ 95.00","45","4.3",["15 May, 2021","03:40 PM"]],[["img-8.png","Sweatshirt for Men (Pink)","Clothes"],"20","$ 120.00","48","4.2",["21 Jun, 2021","12:18 PM"]],[["img-9.png","Reusable Ecological Coffee Cup","Tableware & Dinnerware"],"14","$ 125.00","55","4.3",["15 Jan, 2021","10:29 AM"]],[["img-10.png","Travel Carrying Pouch Bag","Bags, Wallets and Luggage"],"20","$ 115.00","60","4.3",["15 Jun, 2021","03:51 Pm"]],[["img-1.png","Half Sleeve Round Neck T-Shirts","Clothes"],"12","$ 115.00","48","4.2",["12 Oct, 2021","10:05 AM"]],[["img-2.png","Urban Ladder Pashe Chair","Furniture"],"06","$ 160.00","30","4.3",["06 Jan, 2021","01:31 PM"]]]}).render(document.getElementById("table-product-list-all"));var options,chart,swiper,linechartcustomerColors=getChartColorsArray("customer_impression_charts"),counterValue=(linechartcustomerColors&&(options={series:[{name:"Orders",type:"area",data:[34,65,46,68,49,61,42,44,78,52,63,67]},{name:"Earnings",type:"bar",data:[89.25,98.58,68.74,108.87,77.54,84.03,51.24,28.57,92.57,42.36,88.51,36.57]},{name:"Refunds",type:"line",data:[8,12,7,17,21,11,5,9,7,29,12,35]}],chart:{height:370,type:"line",toolbar:{show:!1}},stroke:{curve:"straight",dashArray:[0,0,8],width:[2,0,2.2]},fill:{opacity:[.1,.9,1]},markers:{size:[0,0,0],strokeWidth:2,hover:{size:4}},xaxis:{categories:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],axisTicks:{show:!1},axisBorder:{show:!1}},grid:{show:!0,xaxis:{lines:{show:!0}},yaxis:{lines:{show:!1}},padding:{top:0,right:-2,bottom:15,left:10}},legend:{show:!0,horizontalAlign:"center",offsetX:0,offsetY:-5,markers:{width:9,height:9,radius:6},itemMargin:{horizontal:10,vertical:0}},plotOptions:{bar:{columnWidth:"30%",barHeight:"70%"}},colors:linechartcustomerColors,tooltip:{shared:!0,y:[{formatter:function(e){return void 0!==e?e.toFixed(0):e}},{formatter:function(e){return void 0!==e?"$"+e.toFixed(2)+"k":e}},{formatter:function(e){return void 0!==e?e.toFixed(0)+" Sales":e}}]}},(chart=new ApexCharts(document.querySelector("#customer_impression_charts"),options)).render()),document.querySelector(".counter-value")),VerticalSwiper=(counterValue&&(counter=document.querySelectorAll(".counter-value"),speed=250,counter)&&Array.from(counter).forEach(function(a){!function e(){var t=+a.getAttribute("data-target"),r=+a.innerText,i=t/speed;i<1&&(i=1),r<t?(a.innerText=(r+i).toFixed(0),setTimeout(e,1)):a.innerText=t}()}),document.querySelector(".vertical-swiper"));VerticalSwiper&&(swiper=new Swiper(".vertical-swiper",{slidesPerView:2,spaceBetween:10,mousewheel:!0,loop:!0,direction:"vertical",autoplay:{delay:2500,disableOnInteraction:!1}}));