package main

import (
	"bufio"
	"fmt"
	"log"
	"os"
	"strings"
)

var (
	PartOneResult      int
	PartTwoResult      int
	Table              map[string]map[int][]int
	TableSize          int
	TableRows          int
	PartOneResultTable map[int]map[int]bool
	PartTwoResultTable map[int]map[int]bool
)

func readFileByLine() {
	file, err := os.Open("./day8/input")
	if err != nil {
		log.Fatal(err)
	}
	defer func(file *os.File) {
		err := file.Close()
		if err != nil {
			log.Fatal(err)
		}
	}(file)

	scanner := bufio.NewReader(file)
	TableRows = 0
	TableSize = 0
	Table = map[string]map[int][]int{}
	for line, err := scanner.ReadString('\n'); err == nil; line, err = scanner.ReadString('\n') {
		array := strings.Split(strings.TrimSpace(line), "")
		TableSize = len(array)
		for j, k := range array {
			if k != "." {
				if Table[k] == nil {
					Table[k] = make(map[int][]int)
				}

				Table[k][TableRows] = append(Table[k][TableRows], j)
			}
		}
		TableRows++
	}
	TableRows--
	TableSize--

}

func main() {
	readFileByLine()
	Part1()
	Part2()
	fmt.Println("Result for part 1: ", PartOneResult)
	fmt.Println("Result for part 2: ", PartTwoResult)
}
