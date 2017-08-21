CKEDITOR.on("dialogDefinition", function(event) {
  var dialogName = event.data.name;
  var dialogDefinition = event.data.definition;

  if (dialogName === 'table') {
    var info = dialogDefinition.getContents("info");

    info.get("txtWidth")["default"] = "100%"; // Set default width to 100%
    info.get("txtBorder")["default"] = "0"; // Set border to 0
    info.get("txtCellSpace")["default"] = "0"; // Set cellspacing to 0
    info.get("txtCellPad")["default"] = "0"; // Set cellpadding to 0
    info.get("selHeaders")["default"] = "row"; // Set table header to row
  }
});

CKEDITOR.replace("editor1");
