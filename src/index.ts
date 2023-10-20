document.getElementById("lorem").onsubmit = async (event) => {
  event.preventDefault()
  // Get the currently selected element in the Designer
  const el = await webflow.getSelectedElement()
  if (el && el.textContent) {
    // If we found the element and it has the ability to update the text content,
    // replace it with some placeholder text
    el.setTextContent(
      "Hello World! This is my first Webflow Application!!!"
    )
    // Finally, save the changes to the element & they will be reflected in the Designer
    await el.save()
  }

}

const urlParams = new URLSearchParams(window.location.search);
const myParam = urlParams.get('access_token');

document.getElementById("token_container").innerHTML = myParam;