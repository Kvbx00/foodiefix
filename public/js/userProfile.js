function toggleEditing(fieldNames) {
    if (!Array.isArray(fieldNames)) {
        fieldNames = [fieldNames];
    }

    fieldNames.forEach(fieldName => {
        const inputField = document.getElementById(fieldName);
        if (inputField.readOnly) {
            inputField.readOnly = false;
            inputField.style.border = '1px solid #ccc';
            inputField.style.pointerEvents = 'all';
        } else {
            inputField.readOnly = true;
            inputField.style.border = '0';
            inputField.style.pointerEvents = 'none';
        }
    });
}

function toggleSelectEditing(fieldName) {
    const selectField = document.getElementById(fieldName);
    if (selectField.disabled) {
        selectField.disabled = false;
        selectField.style.border = '1px solid #ccc';
        selectField.style.pointerEvents = 'all';
        selectField.style.appearance = 'auto';
    } else {
        selectField.disabled = true;
        selectField.style.border = '0';
        selectField.style.pointerEvents = 'none';
        selectField.style.appearance = 'none';
    }
}
