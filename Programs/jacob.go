package main

import (
	"fmt"
	"strings"

	"fyne.io/fyne/v2"
	"fyne.io/fyne/v2/app"
	"fyne.io/fyne/v2/container"
	"fyne.io/fyne/v2/widget"
)

func main() {
	// Create the application
	a := app.New()
	w := a.NewWindow("Word Counter")
	w.Resize(fyne.NewSize(400, 300))

	// Create input field and label
	input := widget.NewMultiLineEntry()
	input.SetPlaceHolder("Type or paste text here...")
	input.Wrapping = fyne.TextWrapWord
	result := widget.NewLabel("Word Count: 0")

	// Button to count words
	countButton := widget.NewButton("Count Words", func() {
		words := strings.Fields(input.Text)
		result.SetText(fmt.Sprintf("Word Count: %d", len(words)))
	})

	// Layout
	w.SetContent(container.NewVBox(input, countButton, result))
	w.ShowAndRun()
}
