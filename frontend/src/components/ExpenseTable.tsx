import type { Expense } from '../types'
import { Spinner } from './ui/Spinner'
interface ExpenseTableProps {
    expenses: Expense[]
    loading?: boolean
}
function formatAmount(amount: number | null): string {
    if (amount === null) return '-'
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
    }).format(amount / 100)
}
function formatCnpj(cnpj: string | null): string {
    if (!cnpj) return '-'
    if (cnpj.length !== 14) return cnpj
    return cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, '$1.$2.$3/$4-$5')
}
export function ExpenseTable({ expenses, loading = false }: ExpenseTableProps) {
    if (loading) return <Spinner />
    if (expenses.length === 0) {
        return (
            <div className="rounded-xl border border-gray-200 bg-white p-8 text-center text-gray-500 shadow-sm">
                Nenhuma despesa encontrada.
            </div>
        )
    }
    return (
        <>
            <div className="hidden overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm md:block">
                <div className="overflow-x-auto">
                    <table className="min-w-full text-left text-sm">
                        <thead className="bg-gray-50 text-gray-600">
                        <tr>
                            <th className="px-4 py-3">Colaborador</th>
                            <th className="px-4 py-3">CNPJ</th>
                            <th className="px-4 py-3">Estabelecimento</th>
                            <th className="px-4 py-3">Data</th>
                            <th className="px-4 py-3">Categoria</th>
                            <th className="px-4 py-3">Valor</th>
                        </tr>
                        </thead>
                        <tbody>
                        {expenses.map((expense, index) => (
                            <tr key={index} className="border-t border-gray-100">
                                <td className="px-4 py-3">{expense.collaborator ?? '-'}</td>
                                <td className="px-4 py-3">{formatCnpj(expense.cnpj)}</td>
                                <td className="px-4 py-3">{expense.merchant_name ?? '-'}</td>
                                <td className="px-4 py-3">{expense.date ?? '-'}</td>
                                <td className="px-4 py-3">{expense.category ?? '-'}</td>
                                <td className="px-4 py-3 font-medium">{formatAmount(expense.amount)}</td>
                            </tr>
                        ))}
                        </tbody>
                    </table>
                </div>
            </div>
            <div className="flex flex-col gap-4 md:hidden">
                {expenses.map((expense, index) => (
                    <div
                        key={index}
                        className="rounded-xl border border-gray-200 bg-white p-4 shadow-sm"
                    >
                        <p className="font-semibold text-gray-900">{expense.collaborator ?? '-'}</p>
                        <p className="text-sm text-gray-600">{expense.merchant_name ?? '-'}</p>
                        <div className="mt-3 grid grid-cols-2 gap-2 text-sm">
                            <div>
                                <span className="text-gray-500">CNPJ</span>
                                <p>{formatCnpj(expense.cnpj)}</p>
                            </div>
                            <div>
                                <span className="text-gray-500">Data</span>
                                <p>{expense.date ?? '-'}</p>
                            </div>
                            <div>
                                <span className="text-gray-500">Categoria</span>
                                <p>{expense.category ?? '-'}</p>
                            </div>
                            <div>
                                <span className="text-gray-500">Valor</span>
                                <p className="font-medium">{formatAmount(expense.amount)}</p>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </>
    )
}