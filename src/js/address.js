const base_url = document.querySelector("meta[name=base_url]").getAttribute("content");

let municipalities = null;

const setAddress = async () => {
	const response = await fetch(`${base_url}/src/json/address.json`);
	const data = await response.json();
	const { municipality_list } = data.province_list["CAMARINES SUR"];
	municipalities = municipality_list;
	const select = document.querySelector("#municipality");
	for (const key in municipality_list) {
		let option = document.createElement("option");
		option.setAttribute("value", key);
		option.textContent = key;

		select.appendChild(option);
	}

	handleBarangay();
};

const handleBarangay = (event = null) => {
	const { barangay_list } = municipalities[municipality.value];

	barangay.innerHTML = " ";
	for (const value of barangay_list) {
		let option = document.createElement("option");
		option.setAttribute("value", value);
		option.textContent = value;
		barangay.appendChild(option);
	}
};

let municipality = document.querySelector("#municipality");
let barangay = document.querySelector("#barangay");
municipality.addEventListener("change", handleBarangay);

setAddress();
