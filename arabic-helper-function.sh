#!/bin/bash

# Add this to your ~/.bashrc or ~/.bash_profile for permanent use

# Function to reverse Arabic text
ar() {
    if [ -z "$1" ]; then
        echo "Usage: ar 'your arabic text'"
        echo "Example: ar 'مرحبا بك'"
        return 1
    fi

    local input="$*"
    local reversed=""
    local len=${#input}

    for ((i=len-1; i>=0; i--)); do
        reversed="${reversed}${input:$i:1}"
    done

    echo "$reversed"
}

# Function for interactive Arabic input
ari() {
    echo "Type your Arabic text (press Ctrl+D when done):"
    local input=$(cat)
    local reversed=""
    local len=${#input}

    for ((i=len-1; i>=0; i--)); do
        reversed="${reversed}${input:$i:1}"
    done

    echo ""
    echo "Reversed (copy this):"
    echo "$reversed"
}

echo "Arabic helper functions loaded!"
echo "Usage:"
echo "  ar 'text'  - Reverse Arabic text"
echo "  ari        - Interactive mode"
