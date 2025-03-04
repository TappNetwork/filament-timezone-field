window.setTimezoneFromBrowser = function (id) {
  const selectElement = document.getElementById(id);
  let timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
  // let component = Livewire.find(id);
  // let component = Livewire.getByName(id);
  // component.$set("value", timezone);
  selectElement.value = timezone;
  debugger;
  // Trigger change event for Alpine to update
  // selectElement.dispatchEvent(new Event("change"));
};
