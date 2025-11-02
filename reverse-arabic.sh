#!/bin/bash

# Script to reverse Arabic text for RTL terminal issues
# Usage: ./reverse-arabic.sh "your arabic text"

reverse_text() {
    local input="$1"
    local reversed=""
    local len=${#input}

    for ((i=len-1; i>=0; i--)); do
        reversed="${reversed}${input:$i:1}"
    done

    echo "$reversed"
}

if [ -z "$1" ]; then
    echo "Usage: ./reverse-arabic.sh 'your text'"
    echo "Example: ./reverse-arabic.sh 'مرحبا'"
    exit 1
fi

reversed=$(reverse_text "$1")
echo "$reversed"
