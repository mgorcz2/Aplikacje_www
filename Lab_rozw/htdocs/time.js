function gettheDate()
{
	Todays = new Date();
	TheDate = "" + (Todays.getMonth()+1)+ " / " + (Todays.getFullYear());
	document.getElementById("data").innerText = TheDate;
}