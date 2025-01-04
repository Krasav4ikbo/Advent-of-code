package main

func Part1(arrayValues map[int]map[int]int) {

	for i := range len(arrayValues) {

		for j := range len(arrayValues[i]) {
			if arrayValues[i][j] == 0 {
				search(i, j, arrayValues)
				for a := range len(ExistsValues) {
					for b := range len(ExistsValues[a]) {
						ExistsValues[a][b] = false
					}
				}
			}
		}

	}
}

func search(i, j int, arrayValues map[int]map[int]int) {
	if arrayValues[i][j] == 9 && ExistsValues[i][j] == false {
		//fmt.Println("i: ", i, j)
		ExistsValues[i][j] = true
		PartOneResult++
		return
	}
	if arrayValues[i+1][j]-arrayValues[i][j] == 1 {
		search(i+1, j, arrayValues)
	}
	if arrayValues[i-1][j]-arrayValues[i][j] == 1 {
		search(i-1, j, arrayValues)
	}
	if arrayValues[i][j+1]-arrayValues[i][j] == 1 {
		search(i, j+1, arrayValues)
	}
	if arrayValues[i][j-1]-arrayValues[i][j] == 1 {
		search(i, j-1, arrayValues)
	}
}
