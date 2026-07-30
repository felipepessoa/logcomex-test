import type {ExpenseFilters} from "../types";
import {Button} from "./ui/Button.tsx";

interface ExpenseFiltersProps {
    filters: ExpenseFilters
    onChange: (filters: ExpenseFilters) => void
    onSearch: () => void
    onClear: () => void
    loading?: boolean
}

export function ExpenseFilters({
                                   filters,
                                   onChange,
                                   onSearch,
                                   onClear,
                                   loading = false
                               }: ExpenseFiltersProps) {
    const update = (field: keyof ExpenseFilters, value: string) => {
        onChange({...filters, [field]: value})
    }

    return (
        <div className="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 className="mb-4 text-lg font-semibold text-gray-900">Pesquisar despesas</h2>
            <div className="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <input
                    className="rounded-lg border border-gray-300 px-3 py-2 text-sm"
                    placeholder="Colaborador"
                    value={filters.collaborator ?? ''}
                    onChange={(e) => update('collaborator', e.target.value)}
                />
                <input
                    className="rounded-lg border border-gray-300 px-3 py-2 text-sm"
                    placeholder="CNPJ"
                    value={filters.cnpj ?? ''}
                    onChange={(e) => update('cnpj', e.target.value)}
                />
                <input
                    className="rounded-lg border border-gray-300 px-3 py-2 text-sm"
                    placeholder="Estabelecimento"
                    value={filters.merchant ?? ''}
                    onChange={(e) => update('merchant', e.target.value)}
                />
                <input
                    className="rounded-lg border border-gray-300 px-3 py-2 text-sm"
                    placeholder="Categoria"
                    value={filters.category ?? ''}
                    onChange={(e) => update('category', e.target.value)}
                />
            </div>
            <div className="mt-4 flex gap-3">
                <Button onClick={onSearch} loading={loading}>
                    Buscar
                </Button>
                <Button variant="secondary" onClick={onClear} disabled={loading}>
                    Limpar
                </Button>
            </div>
        </div>
    )
}