let container = document.querySelector(".container");
let btn = document.getElementById("spin");
let number = Math.ceil(Math.random() * 1000);

btn.onclick = function () {
	
	console.log("EVPPPPP NE ZNMAM")
		//disable dugme
		var myButton = $('#spin');
		// myButton.disabled = true;
		if (parseInt($("#tokeni")) == 0) {
			alert("Nema tokena")
			return;
		}
		// console.log(document.getElementById("tokeni"));
		var podaci = "nista";
		console.log("teodora");
		console.log(broj);
		container.style.transform = "rotate(" + number + "deg)";
		broj = (number + 22.5) % 360 / 45;
		number += Math.ceil(Math.random() * 1000);

		console.log(broj);
		if (parseInt(broj) != 5) {
			var p = {
				broj: podaci,

			};

		}
		// console.log("lana");
		// console.log(document.getElementsById("two").innerHTML);
		// console.log(document.getElementById("dobitak").innerText);
		setTimeout(function () {
			//vrati dugme;

			// console.log("lll");
			switch (parseInt(broj)) {
				case 0:
					document.getElementById("dobitak").innerHTML = "20%";
					podaci = "20%";
					break;
				case 1:
					document.getElementById("dobitak").innerHTML = "1000din";
					podaci = "1000din";
					break;
				case 2:
					document.getElementById("dobitak").innerHTML = "2000din";
					podaci = "2000din";
					break;
				case 3:
					document.getElementById("dobitak").innerHTML = "10%";
					podaci = "10%";
					break;
				case 4:
					document.getElementById("dobitak").innerHTML = "5%";
					podaci = "5%"
					break;
				case 5:
					document.getElementById("dobitak").innerHTML = "nista";
					break;
				case 6:
					document.getElementById("dobitak").innerHTML = "1500din";
					podaci = "1500din";
					break;
				case 7:
					document.getElementById("dobitak").innerHTML = "8%";
					podaci = "8%";
					break;



			}
			// console.log("lanaaa");
			$("#dobitak").val(podaci);
			// let myButton = document.getElementById('spin');

			// myButton.disabled = true;
			// myButton = document.getElementById('spin_dugme');
			// myButton.disabled = false;
			// console.log(myButton.disabled);



		}, 3000)
}