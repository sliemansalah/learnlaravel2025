const fs = require('fs');
const path = require('path');
const { exec } = require('child_process');

// Files to convert
const conversions = [
    { input: 'README-EN.md', output: 'README-EN.pdf' },
    { input: 'README.md', output: 'README-AR.pdf' },
    { input: 'PRACTICE-GUIDE-EN.md', output: 'PRACTICE-GUIDE-English.pdf' },
    { input: 'PRACTICE-GUIDE-AR.md', output: 'PRACTICE-GUIDE-Arabic.pdf' },
    { input: 'QUICK-REFERENCE-EN.md', output: 'QUICK-REFERENCE-English.pdf' },
    { input: 'QUICK-REFERENCE.md', output: 'QUICK-REFERENCE-Arabic.pdf' }
];

console.log('📄 Markdown to PDF Converter');
console.log('============================\n');

// Check if md-to-pdf is installed
exec('npx md-to-pdf --version', (error) => {
    if (error) {
        console.log('⚠️  md-to-pdf package not found. Installing...\n');
        console.log('Please run: npm install -g md-to-pdf');
        console.log('Then run this script again.\n');
        process.exit(1);
    }

    convertFiles();
});

async function convertFiles() {
    let completed = 0;
    let total = conversions.length;

    console.log(`Converting ${total} files...\n`);

    for (const file of conversions) {
        if (!fs.existsSync(file.input)) {
            console.log(`❌ File not found: ${file.input}`);
            continue;
        }

        console.log(`🔄 Converting ${file.input} → ${file.output}...`);

        await new Promise((resolve) => {
            exec(`npx md-to-pdf "${file.input}" --dest "${file.output}"`, (error, stdout, stderr) => {
                if (error) {
                    console.log(`   ❌ Error: ${error.message}`);
                } else {
                    console.log(`   ✅ Created: ${file.output}`);
                    completed++;
                }
                resolve();
            });
        });
    }

    console.log(`\n✨ Conversion complete! ${completed}/${total} files created.`);
}
