package main

func Part1() {
	PartOneResultTable = map[int]map[int]bool{}
	for _, vv := range Table {
		for i, v := range vv {
			for _, f := range v {
				search(vv, []int{i, f})
			}
		}
	}

	for _, v := range PartOneResultTable {
		PartOneResult += len(v)
	}
}

func search(table map[int][]int, pair []int) {
	for i, v := range table {
		for _, f := range v {
			if i != pair[0] || f != pair[1] {
				diffI := pair[0] - i
				diffJ := pair[1] - f

				isCorrect := false
				if diffI < 0 && pair[0]+diffI >= 0 {
					if diffJ < 0 && pair[1]+diffJ >= 0 {
						isCorrect = true
					}
					if diffJ > 0 && pair[1]+diffJ <= TableSize {
						isCorrect = true
					}
				}

				if diffI > 0 && pair[0]+diffI <= TableRows {
					if diffJ < 0 && pair[1]+diffJ >= 0 {
						isCorrect = true
					}
					if diffJ > 0 && pair[1]+diffJ <= TableSize {
						isCorrect = true
					}
				}
				//fmt.Println("TableSize: ", pair[0]+diffI, pair[0], diffI)
				if isCorrect {
					if PartOneResultTable[pair[0]+diffI] == nil {
						PartOneResultTable[pair[0]+diffI] = make(map[int]bool)
					}
					PartOneResultTable[pair[0]+diffI][pair[1]+diffJ] = true
				}

			}
		}
	}
}
