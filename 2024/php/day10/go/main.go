package main

import (
	"bufio"
	"fmt"
	"log"
	"os"
	"strconv"
	"strings"
)

var (
	PartOneResult int
	PartTwoResult int64
	ExistsValues  map[int]map[int]bool
)

func readFileByLine() {
	file, err := os.Open("./day10/input")
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
	i := 0
	arrayValues := map[int]map[int]int{}
	ExistsValues = map[int]map[int]bool{}
	for line, err := scanner.ReadString('\n'); err == nil; line, err = scanner.ReadString('\n') {
		array := strings.Split(strings.TrimSpace(line), "")
		arrayValues[i] = make(map[int]int)
		ExistsValues[i] = make(map[int]bool)
		for j, k := range array {
			number, _ := strconv.Atoi(k)
			arrayValues[i][j] = number
			ExistsValues[i][j] = false
		}
		i++
	}
	//fmt.Println("arrayValues: ", arrayValues)
	Part1(arrayValues)
	Part2(arrayValues)

}

func main() {
	readFileByLine()
	//Part2()
	fmt.Println("Result for part 1: ", PartOneResult)
	fmt.Println("Result for part 2: ", PartTwoResult)
}
