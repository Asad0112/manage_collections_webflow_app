var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
document.getElementById("lorem").onsubmit = (event) => __awaiter(this, void 0, void 0, function* () {
    event.preventDefault();
    // Get the currently selected element in the Designer
    const el = yield webflow.getSelectedElement();
    if (el && el.textContent) {
        // If we found the element and it has the ability to update the text content,
        // replace it with some placeholder text
        el.setTextContent("Hello World! This is my first Webflow Application!!!");
        // Finally, save the changes to the element & they will be reflected in the Designer
        yield el.save();
    }
});
const urlParams = new URLSearchParams(window.location.search);
const myParam = urlParams.get('access_token');
alert(myParam);
document.getElementById("token_container").innerHTML = myParam;
