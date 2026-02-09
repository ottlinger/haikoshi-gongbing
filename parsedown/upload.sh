#!/bin/bash
# Source and destination directories
SOURCE_DIR="."
DEST_DIR="./upload"
# Cleanup first
rm -rf "$DEST_DIR"
mkdir -p "$DEST_DIR"
# Copy files, excluding specific patterns
rsync -av --exclude='upload' --exclude='*.sh' --exclude='vendor' --exclude='*.md' --exclude='composer*' --exclude='docker-compose*' --exclude='LICENSE*' --exclude='*.iml' --exclude='*example' "$SOURCE_DIR/" "$DEST_DIR/"
