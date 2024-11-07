function calculateWeight() {
	const weight = parseFloat(document.getElementById('weight').value);
	const planet = document.getElementById('planet').value;
	let weightOnPlanet;
	
	const gravity = {
		Merkury: 0.38,
		Venus: 0.91,
		Mars: 0.38,
		Jowisz: 2.34,
		Saturn: 1.06,
		Uran: 0.92,
		Neptun: 1.19
		};
	if (weight && gravity[planet]){
		weightOnPlanet=weight*gravity[planet];
		
		document.getElementById('result').innerText = `Na plenecie ${planet} wazysz ${weightOnPlanet.toFixed(2)} kg`;
		}
		else{
		document.getElementById('result').innerText=`Wprowadz prawidlowe dane`;
		}
}


$(document).ready(function() {
    console.log("Załadowany!"); // Sprawdź w konsoli
    $(document).on("click",".main_glowna", function() {
        $(this).animate({
            backgroundColor: "red"
        }, 1500);
    });
});