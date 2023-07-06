#!/usr/bin/env bash

main() {
  touch Readme.md
  local insert_point=$(grep -n '*' Readme.md | cut -d : -f1| head -1)
  local head=$((insert_point - 1))
  local tail=$((insert_point))
  head -$head Readme.md > Readme.head.md
  tail -n +$tail Readme.md > Readme.tail.md

  for name in $(find src -name "*.md"); do
    if ! grep -q "$name" Readme.md; then
      echo "* [$name]($name)" >> Readme.head.md
    fi
  done
  cat Readme.head.md Readme.tail.md > Readme.md
  rm Readme.head.md Readme.tail.md
}

main "$@"