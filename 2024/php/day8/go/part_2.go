package main

func Part2() {
	PartTwoResultTable = map[int]map[int]bool{}
	for _, vv := range Table {
		for i, v := range vv {
			for _, f := range v {
				searchLoop(vv, []int{i, f})
			}
		}
	}

	for _, v := range PartTwoResultTable {
		PartTwoResult += len(v)
	}
}

func searchLoop(table map[int][]int, pair []int) {
	for i, v := range table {
		for _, f := range v {
			if i != pair[0] || f != pair[1] {
				if PartTwoResultTable[pair[0]] == nil {
					PartTwoResultTable[pair[0]] = make(map[int]bool)
				}
				PartTwoResultTable[pair[0]][pair[1]] = true
				for count := range 50 {
					diffI := (pair[0] - i) * (count + 1)
					diffJ := (pair[1] - f) * (count + 1)

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

					if isCorrect {
						if PartTwoResultTable[pair[0]+diffI] == nil {
							PartTwoResultTable[pair[0]+diffI] = make(map[int]bool)
						}

						PartTwoResultTable[pair[0]+diffI][pair[1]+diffJ] = true
					}
				}
			}
		}
	}
}
