function calculateWeight() {
	const weight = parseFloat(document.getElementById('weight').value);
	const planet = document.getElementById('planet').value;
	let weightOnPlanet;
	
	const gravity = {
		Mercury: 0.38,
		Venus: 0.91,
		Mars: 0.38,
		Jupiter: 2.34,
		Saturn: 1.06,
		Uranus: 0.92,
		Neptune: 1.19
		};
	if (weight && gravity[planet]){
		weightOnPlanet=weight*gravity[planet];
		
		document.getElementById('result').innerText = `Na plenecie wazysz ${weightOnPlanet.toFixed(2)} kg`;
		}
		else{
		document.getElementById('result').innerText=`Wprowadz prawidlowe dane`;
		}
}
