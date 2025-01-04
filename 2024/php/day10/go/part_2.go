package main

func Part2(arrayValues map[int]map[int]int) {
	for i := range len(arrayValues) {
		for j := range len(arrayValues[i]) {
			if arrayValues[i][j] == 0 {
				searchLoop(i, j, arrayValues)
				//for a := range len(ExistsValues) {
				//	for b := range len(ExistsValues[a]) {
				//		ExistsValues[a][b] = false
				//	}
				//}
			}
		}

	}
}

func searchLoop(i, j int, arrayValues map[int]map[int]int) {
	if arrayValues[i][j] == 9 {
		//fmt.Println("i: ", i, j)
		ExistsValues[i][j] = true
		PartTwoResult++
		return
	}
	if arrayValues[i+1][j]-arrayValues[i][j] == 1 {
		searchLoop(i+1, j, arrayValues)
	}
	if arrayValues[i-1][j]-arrayValues[i][j] == 1 {
		searchLoop(i-1, j, arrayValues)
	}
	if arrayValues[i][j+1]-arrayValues[i][j] == 1 {
		searchLoop(i, j+1, arrayValues)
	}
	if arrayValues[i][j-1]-arrayValues[i][j] == 1 {
		searchLoop(i, j-1, arrayValues)
	}
}
