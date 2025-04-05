// go_syntax_checker.go
package main

import (
	"go/parser"
	"go/token"
	"log"
	"os"
)

func main() {
	if len(os.Args) < 2 {
		log.Fatal("Missing file path")
	}
	fset := token.NewFileSet()
	_, err := parser.ParseFile(fset, os.Args[1], nil, parser.AllErrors)
	if err != nil {
		log.Fatal(err)
	}
}
