var code_parts = JSON.parse($("input[name='code_parts']").val());
var list_part = JSON.parse($("input[name='list_part']").val());
var list_separator = JSON.parse($("input[name='list_separator']").val());

function AddPart(part, value, separator) {
	var self = this;

	self.part = ko.observable(part);
	self.value = ko.observable(value);
	self.separator = ko.observable(separator);
	self.hasValue = ko.observable(false);

	self.toggleCodeValue = () => {
		var part = self.part();
		self.hasValue(false);
		if (part === "increment" || part === "alpha_numeric") {
			self.hasValue(true);
		}
	};

	self.toggleCodeValue();
}

function AddList(list) {
	var self = this;

	self.key = ko.observable(list.key);
	self.value = ko.observable(list.value);
}

var ViewModel = () => {
	var self = this;

	self.parts = ko.observableArray([]);
	self.ListPart = ko.observableArray([]);
	self.ListSeparator = ko.observableArray([]);

	self.removePart = (part) => {
		self.parts.remove(part);
	};
	self.addPart = () => {
		self.parts.push(new AddPart("", "", ""));
	};
};

ko.applyBindings(ViewModel);

for (let i = 0; i < list_part.length; i++) {
	this.ListPart.push(new AddList(list_part[i]));
}
for (let i = 0; i < list_separator.length; i++) {
	this.ListSeparator.push(new AddList(list_separator[i]));
}
if (code_parts.length > 0) {
	for (let i = 0; i < code_parts.length; i++) {
		this.parts.push(
			new AddPart(
				code_parts[i].part,
				code_parts[i].value,
				code_parts[i].separator
			)
		);
	}
} else {
	this.parts.push(new AddPart("", "", ""));
}
