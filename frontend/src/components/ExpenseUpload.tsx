import {useRef, useState} from "react";
import {Button} from "./ui/Button.tsx";

interface ExpenseUploadProps {
    onUpload: (file: File) => void
    loading?: boolean
}

export function ExpenseUpload({onUpload, loading = false}: ExpenseUploadProps) {
    const inputRef = useRef<HTMLInputElement>(null)
    const [file, setFile] = useState<File | null>(null)
    const handleSubmit = async () => {
        if (!file) return
        await onUpload(file)
        setFile(null)
        if (inputRef.current) inputRef.current.value = ''
    }
    return (
        <div className="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 className="mb-4 text-lg font-semibold text-gray-900">Importar despesas</h2>
            <input
                ref={inputRef}
                type="file"
                accept="application/pdf"
                disabled={loading}
                onChange={(e) => setFile(e.target.files?.[0] ?? null)}
                className="block w-full text-sm"
            />
            <div className="mt-4">
                <Button onClick={handleSubmit} loading={loading} disabled={!file}>Importar</Button>
            </div>
        </div>


    )
}